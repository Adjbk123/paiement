<?php

namespace App\Http\Controllers;

use App\Models\PaiementInscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // ================= FILTRES =================
        $year = $request->year ?? now()->year;
        $week = $request->week ?? now()->weekOfYear;

        // ================= KPI ENSEIGNEMENTS =================
        $inscriptions = PaiementInscription::whereYear('created_at', $year)
                        ->whereRaw('WEEK(created_at, 1) = ?', [$week])
                        ->where('status', 'approved');

        $inscriptionsParEnseignement = $inscriptions
            ->select('enseignement_id', DB::raw('SUM(montant) as total'))
            ->groupBy('enseignement_id')
            ->pluck('total', 'enseignement_id');

        $totalMaternel   = $inscriptionsParEnseignement[1] ?? 0;
        $totalPrimaire   = $inscriptionsParEnseignement[2] ?? 0;
        $totalSecondaire = $inscriptionsParEnseignement[3] ?? 0;
        $totalAutre      = $inscriptionsParEnseignement[4] ?? 0;

        // ================= STATISTIQUES MENSUELLES =================
        $statistiquesMensuelles = PaiementInscription::select(
                DB::raw('MONTH(created_at) as mois'),
                DB::raw('SUM(montant) as montant')
            )
            ->whereYear('created_at', $year)
            ->where('status', 'approved')
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $monthlyLabels = [];
        $monthlySales  = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyLabels[] = ucfirst(Carbon::create()->month($m)->locale('fr')->translatedFormat('F'));
            $moisData = $statistiquesMensuelles->firstWhere('mois', $m);
            $monthlySales[] = $moisData->montant ?? 0;
        }

        // ================= STATISTIQUES HEBDOMADAIRES =================
        $statistiquesSemaine = PaiementInscription::select(
                DB::raw('DAYOFWEEK(created_at) as jour'),
                DB::raw('SUM(montant) as montant')
            )
            ->whereYear('created_at', $year)
            ->whereRaw('WEEK(created_at, 1) = ?', [$week])
            ->where('status', 'approved')
            ->groupBy('jour')
            ->orderBy('jour')
            ->get();

        $dailyLabels = [];
        $dailySales  = [];
        foreach ($statistiquesSemaine as $stat) {
            // DAYOFWEEK = 1 (Dimanche) à 7 (Samedi)
            $jour = Carbon::create()->dayOfWeek($stat->jour - 1)->locale('fr')->translatedFormat('l');
            $dailyLabels[] = ucfirst($jour);
            $dailySales[] = $stat->montant;
        }

        // ================= FOOTER FINANCIER =================
        $totalRevenu   = PaiementInscription::whereYear('created_at', $year)
                            ->whereRaw('WEEK(created_at, 1) = ?', [$week])
                            ->where('status', 'approved')->sum('montant');

        $totalPending  = PaiementInscription::whereYear('created_at', $year)
                            ->whereRaw('WEEK(created_at, 1) = ?', [$week])
                            ->where('status', 'pending')->sum('montant');

        $totalApproved = $totalRevenu; // même que totalRevenu
        $totalFailed   = PaiementInscription::whereYear('created_at', $year)
                            ->whereRaw('WEEK(created_at, 1) = ?', [$week])
                            ->where('status', 'failed')->sum('montant');

        // ================= RETOUR VUE =================
        return view('dashboard', compact(
            'year','week',
            'totalMaternel','totalPrimaire','totalSecondaire','totalAutre',
            'monthlyLabels','monthlySales',
            'dailyLabels','dailySales',
            'totalRevenu','totalPending','totalApproved','totalFailed'
        ));
    }
}
