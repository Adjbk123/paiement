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
        // On calcule la somme des tranches 'approved' regroupées par enseignement
        $inscriptionsParEnseignement = DB::table('paiement_tranches')
            ->join('paiement_inscriptions', 'paiement_tranches.paiement_inscription_id', '=', 'paiement_inscriptions.id')
            ->where('paiement_tranches.status', 'approved')
            ->whereNull('paiement_inscriptions.deleted_at')
            ->whereYear('paiement_tranches.created_at', $year)
            ->whereRaw('WEEK(paiement_tranches.created_at, 1) = ?', [$week])
            ->select('paiement_inscriptions.enseignement_id', DB::raw('SUM(paiement_tranches.montant_tranche) as total'))
            ->groupBy('paiement_inscriptions.enseignement_id')
            ->pluck('total', 'enseignement_id');

        $totalMaternel   = $inscriptionsParEnseignement[1] ?? 0;
        $totalPrimaire   = $inscriptionsParEnseignement[2] ?? 0;
        $totalSecondaire = $inscriptionsParEnseignement[3] ?? 0;
        $totalAutre      = $inscriptionsParEnseignement[4] ?? 0;

        // ================= STATISTIQUES MENSUELLES (Année) =================
        $statistiquesMensuelles = DB::table('paiement_tranches')
            ->join('paiement_inscriptions', 'paiement_tranches.paiement_inscription_id', '=', 'paiement_inscriptions.id')
            ->where('paiement_tranches.status', 'approved')
            ->whereNull('paiement_inscriptions.deleted_at')
            ->whereYear('paiement_tranches.created_at', $year)
            ->select(
                DB::raw('MONTH(paiement_tranches.created_at) as mois'),
                DB::raw('SUM(paiement_tranches.montant_tranche) as montant')
            )
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

        // ================= STATISTIQUES HEBDOMADAIRES (Jours) =================
        $statistiquesSemaine = DB::table('paiement_tranches')
            ->join('paiement_inscriptions', 'paiement_tranches.paiement_inscription_id', '=', 'paiement_inscriptions.id')
            ->where('paiement_tranches.status', 'approved')
            ->whereNull('paiement_inscriptions.deleted_at')
            ->whereYear('paiement_tranches.created_at', $year)
            ->whereRaw('WEEK(paiement_tranches.created_at, 1) = ?', [$week])
            ->select(
                DB::raw('DAYOFWEEK(paiement_tranches.created_at) as jour'),
                DB::raw('SUM(paiement_tranches.montant_tranche) as montant')
            )
            ->groupBy('jour')
            ->orderBy('jour')
            ->get();

        $dailyLabels = [];
        $dailySales  = [];
        // On génère les 7 jours de la semaine (1=Dimanche, 7=Samedi en MySQL)
        $joursSemaine = [2, 3, 4, 5, 6, 7, 1]; // On commence par Lundi (2) -> Dimanche (1)
        foreach ($joursSemaine as $j) {
            $nomJour = Carbon::create()->dayOfWeek($j === 7 ? 0 : $j)->locale('fr')->translatedFormat('l');
            if ($j === 1) $nomJour = Carbon::create()->dayOfWeek(0)->locale('fr')->translatedFormat('l'); // Dimanche
            
            // Correction pour Carbon : 0 = Dimanche, 1 = Lundi ...
            $carbonDay = $j - 1; 
            $label = ucfirst(Carbon::now()->startOfWeek(Carbon::MONDAY)->addDays(($j+5)%7)->locale('fr')->translatedFormat('l'));
            
            // Simpler way:
            $labelsMap = [
                1 => 'Dimanche', 2 => 'Lundi', 3 => 'Mardi', 4 => 'Mercredi',
                5 => 'Jeudi', 6 => 'Vendredi', 7 => 'Samedi'
            ];
            
            $dailyLabels[] = $labelsMap[$j];
            $stat = $statistiquesSemaine->firstWhere('jour', $j);
            $dailySales[] = $stat->montant ?? 0;
        }

        // ================= FOOTER FINANCIER =================
        // Total Revenu = Somme des tranches approuvées
        $totalRevenu = DB::table('paiement_tranches')
            ->join('paiement_inscriptions', 'paiement_tranches.paiement_inscription_id', '=', 'paiement_inscriptions.id')
            ->where('paiement_tranches.status', 'approved')
            ->whereNull('paiement_inscriptions.deleted_at')
            ->whereYear('paiement_tranches.created_at', $year)
            ->whereRaw('WEEK(paiement_tranches.created_at, 1) = ?', [$week])
            ->sum('paiement_tranches.montant_tranche');

        // Total Pending = Somme des tranches en attente
        $totalPending = DB::table('paiement_tranches')
            ->join('paiement_inscriptions', 'paiement_tranches.paiement_inscription_id', '=', 'paiement_inscriptions.id')
            ->where('paiement_tranches.status', 'pending')
            ->whereNull('paiement_inscriptions.deleted_at')
            ->whereYear('paiement_tranches.created_at', $year)
            ->whereRaw('WEEK(paiement_tranches.created_at, 1) = ?', [$week])
            ->sum('paiement_tranches.montant_tranche');

        $totalApproved = $totalRevenu;

        // Total Failed = Somme des tranches échouées
        $totalFailed = DB::table('paiement_tranches')
            ->join('paiement_inscriptions', 'paiement_tranches.paiement_inscription_id', '=', 'paiement_inscriptions.id')
            ->where('paiement_tranches.status', 'failed')
            ->whereNull('paiement_inscriptions.deleted_at')
            ->whereYear('paiement_tranches.created_at', $year)
            ->whereRaw('WEEK(paiement_tranches.created_at, 1) = ?', [$week])
            ->sum('paiement_tranches.montant_tranche');

        // ================= STATUTS DOSSIERS =================
        $countSoldes = PaiementInscription::where('status', 'approved')
            ->whereYear('created_at', $year)
            ->whereRaw('WEEK(created_at, 1) = ?', [$week])
            ->count();

        $countPartiels = PaiementInscription::where('status', 'partiel')
            ->whereYear('created_at', $year)
            ->whereRaw('WEEK(created_at, 1) = ?', [$week])
            ->count();

        // ================= RETOUR VUE =================
        return view('dashboard', compact(
            'year','week',
            'totalMaternel','totalPrimaire','totalSecondaire','totalAutre',
            'monthlyLabels','monthlySales',
            'dailyLabels','dailySales',
            'totalRevenu','totalPending','totalApproved','totalFailed',
            'countSoldes', 'countPartiels'
        ));
    }
}
