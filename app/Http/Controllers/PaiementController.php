<?php

namespace App\Http\Controllers;

use App\Exports\PaiementsExport;
use App\Models\Circonscription;
use App\Models\Enseignement;
use App\Models\Formation;
use App\Models\Option;
use App\Models\PaiementInscription;
use App\Models\Parametre;
use App\Models\Region;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class PaiementController extends Controller
{
    // ================= LISTE DES INSCRIPTIONS =================
    public function index(Request $request)
    {
        $query = PaiementInscription::with([
            'enseignement','circonscription','formation','region','province','option'
        ]);

        if ($request->enseignement) {
            if ($request->enseignement == 'autre') {
                $query->whereNotNull('autre_enseignement');
            } else {
                $query->where('enseignement_id', $request->enseignement);
            }
        }

        if ($request->circonscription) {
            $query->where('circonscription_id', $request->circonscription);
        }

        if ($request->formation) {
            $query->where('formation_id', $request->formation);
        }

        if ($request->region) {
            $query->where('region_id', $request->region);
        }

        if ($request->option) {
            $query->where('option_id', $request->option);
        }

        if ($request->date_debut) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->date_fin) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom','like',"%{$search}%")
                  ->orWhere('prenoms','like',"%{$search}%")
                  ->orWhere('email','like',"%{$search}%")
                  ->orWhere('phone','like',"%{$search}%")
                  ->orWhere('token','like',"%{$search}%");
            });
        }

        $perPage = $request->get('per_page', 10);
        $inscriptions = $query->latest()->paginate($perPage);

        $stats = PaiementInscription::selectRaw("status, count(*) as total")
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statsEnseignement = PaiementInscription::selectRaw("enseignement_id, count(*) as total")
            ->with('enseignement')
            ->groupBy('enseignement_id')
            ->get()
            ->map(fn($r) => [
                'nom'   => $r->enseignement?->nom ?? 'Autre',
                'total' => $r->total,
            ])
            ->sortByDesc('total')
            ->values();

        return view('inscriptions.index', [
            'inscriptions'      => $inscriptions,
            'stats'             => $stats,
            'statsEnseignement' => $statsEnseignement,
            'enseignements'   => Enseignement::orderBy('nom')->get(),
            'circonscriptions'=> Circonscription::orderBy('nom')->get(),
            'formations'      => Formation::orderBy('nom')->get(),
            'regions'         => Region::orderBy('nom')->get(),
            'options'         => Option::orderBy('nom')->get(),
        ]);
    }

    // ================= SHOW =================
    public function show($id)
    {
        $inscription = PaiementInscription::with([
            'enseignement','formation','circonscription','departement','district','province','region','option','tranches'
        ])->findOrFail($id);

        return view('inscriptions.show', compact('inscription'));
    }

    // ================= SUPPRIMER =================
    public function destroy($id)
    {
        $inscription = PaiementInscription::findOrFail($id);
        $inscription->delete();

        return redirect()
            ->route('administrateur.gestinscriptions.inscriptions.index')
            ->with('success','Inscription supprimée avec succès.');
    }

    // ================= SUPPRIMER TOUTES LES INSCRIPTIONS =================
    public function destroyAll()
    {
        // Désactive temporairement la vérification des contraintes FK
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PaiementInscription::query()->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()
            ->route('administrateur.gestinscriptions.inscriptions.index')
            ->with('success','Toutes les inscriptions ont été supprimées avec succès.');
    }

   /**
 * Supprimer les inscriptions sélectionnées
 */
public function destroySelected(Request $request)
{
    $request->validate([
        'ids' => 'required|array',
        'ids.*' => 'exists:paiement_inscriptions,id',
    ]);

    $ids = $request->ids;

    // Gestion des contraintes de clés étrangères
    try {
        PaiementInscription::whereIn('id', $ids)->delete();
        return redirect()
            ->route('administrateur.gestinscriptions.inscriptions.index')
            ->with('success', 'Les inscriptions sélectionnées ont été supprimées avec succès.');
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect()
            ->route('administrateur.gestinscriptions.inscriptions.index')
            ->with('error', 'Impossible de supprimer certaines inscriptions car elles sont liées à d’autres données.');
    }
}
    // ================= CHANGER STATUT =================
    public function changeStatus(Request $request, $id)
    {
        $inscription = PaiementInscription::findOrFail($id);
        $request->validate(['status' => 'required|in:pending,approved,failed']);
        $inscription->status = $request->status;
        $inscription->save();

        return back()->with('success','Statut mis à jour avec succès.');
    }

    // ================= EXPORT PDF =================
    public function exportPdf(Request $request)
    {
        $query = PaiementInscription::with([
            'enseignement','circonscription','formation','region','province','option'
        ]);

        if ($request->status) {
            $query->where('status', $request->status);
        } else {
            $query->whereIn('status', ['approved', 'partiel']);
        }

        if ($request->enseignement) {
            if ($request->enseignement == 'autre') {
                $query->whereNotNull('autre_enseignement');
            } else {
                $query->where('enseignement_id',$request->enseignement);
            }
        }
        if ($request->circonscription) { $query->where('circonscription_id',$request->circonscription);}
        if ($request->formation) { $query->where('formation_id',$request->formation);}
        if ($request->region) { $query->where('region_id',$request->region);}
        if ($request->option) { $query->where('option_id',$request->option);}
        if ($request->date_debut) { $query->whereDate('created_at', '>=', $request->date_debut); }
        if ($request->date_fin) { $query->whereDate('created_at', '<=', $request->date_fin); }

        $inscriptions = $query->latest()->get();
        $totalMontant = $inscriptions->sum('montant');

        $pdf = Pdf::loadView('inscriptions.pdf', compact('inscriptions','totalMontant'))
            ->setPaper('A4', 'landscape');

        $filename = 'liste_inscriptions';
        if($request->date_debut) { $filename .= '_du_'.$request->date_debut; }
        if($request->date_fin) { $filename .= '_au_'.$request->date_fin; }
        $filename .= '.pdf';

        return $pdf->download($filename);
    }

    // ================= EXPORT POINT COMPTABLE =================
    public function exportComptablePdf(Request $request)
    {
        $dateDebut = $request->get('date_debut', date('Y-m-d'));
        $dateFin   = $request->get('date_fin', date('Y-m-d'));

        $query = PaiementInscription::with(['enseignement', 'option', 'formation', 'region'])
            ->whereDate('created_at', '>=', $dateDebut)
            ->whereDate('created_at', '<=', $dateFin)
            ->whereIn('status', ['approved', 'partiel']);

        $inscriptions = $query->latest()->get();
        $totalMontant = $inscriptions->sum('montant');
        $parametres   = Parametre::first();

        // Statistiques par enseignement pour le point comptable
        $statsEnseignement = $inscriptions->groupBy(function($item) {
            return $item->enseignement?->nom ?? ($item->autre_enseignement ?? 'Autre');
        })->map(function($group) {
            return [
                'count' => $group->count(),
                'total' => $group->sum('montant')
            ];
        });

        $pdf = Pdf::loadView('inscriptions.comptable_pdf', compact(
            'inscriptions',
            'totalMontant',
            'dateDebut',
            'dateFin',
            'parametres',
            'statsEnseignement'
        ))->setPaper('A4', 'portrait');

        $filename = 'point_comptable_'.$dateDebut.'_au_'.$dateFin.'.pdf';
        return $pdf->download($filename);
    }

    // ================= EXPORT SINGLE PDF =================
    public function exportSinglePdf($id)
    {
        $paiement = PaiementInscription::with([
            'enseignement','formation','circonscription','region','province','option'
        ])->where('status','approved')->findOrFail($id);

        $parametres = Parametre::first();
        $pdf = Pdf::loadView('inscriptions.single_pdf', compact('paiement','parametres'))->setPaper('A4','portrait');
        $fileName = 'recu_paiement_'.$paiement->reference.'.pdf';

        return $pdf->download($fileName);
    }

    // ================= EXPORT CSV =================
    public function exportCsv()
    {
        $inscriptions = PaiementInscription::with(['enseignement','option','formation','circonscription','province','region'])->get();
        $filename = 'inscriptions_'.date('Ymd_His').'.csv';

        $headers = ['Content-Type'=>'text/csv','Content-Disposition'=>"attachment; filename=\"$filename\""];
        $columns = ['Nom','Prénoms','Email','Téléphone','Enseignement','Option','Montant','Statut','Date'];

        $callback = function() use($inscriptions,$columns){
            $file = fopen('php://output','w');
            fputcsv($file,$columns,';');
            foreach($inscriptions as $inscription){
                fputcsv($file,[
                    $inscription->nom,
                    $inscription->prenoms,
                    $inscription->email,
                    $inscription->phone,
                    optional($inscription->enseignement)->nom=='Autre'?$inscription->autre_enseignement:optional($inscription->enseignement)->nom,
                    optional($inscription->option)->nom,
                    $inscription->montant,
                    ucfirst($inscription->status),
                    $inscription->created_at->format('d/m/Y H:i')
                ],';');
            }
            fclose($file);
        };

        return Response::stream($callback,200,$headers);
    }

    // ================= EXPORT EXCEL =================
    public function exportExcel(Request $request)
    {
        $filters = $request->only(['status', 'enseignement', 'circonscription', 'formation', 'region', 'option', 'date_paiement']);
        
        $date = $request->date_paiement;
        $filename = 'inscriptions';
        if($date) $filename .= '_'.$date;
        $filename .= '.xlsx';
        return Excel::download(new PaiementsExport($filters),$filename);
    }

}
