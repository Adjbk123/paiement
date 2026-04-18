<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PaiementInscriptionController;
use App\Livewire\Utilisateurs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//  return view('welcome');
//});

Auth::routes(['register' => false]);
Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
    Route::get('/', 'index'); // Accueil

});


Route::get('/paiement', [App\Http\Controllers\PaiementInscriptionController::class, 'showForm'])->name('frondend.paiement');

// Formulaire et paiement


/*
|--------------------------------------------------------------------------
| PAIEMENT INSCRIPTION - FRONTEND
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| PAIEMENT INSCRIPTION - FRONTEND
|--------------------------------------------------------------------------
*/

// Afficher le formulaire
Route::get('/paiement', [PaiementInscriptionController::class, 'showForm'])
    ->name('frontend.paiement');

// Traitement du paiement
Route::post('/paiement/process', [PaiementInscriptionController::class, 'process'])
    ->name('paiement.process');

// Webhook FedaPay
Route::post('/fedapay/webhook', [PaiementInscriptionController::class, 'webhook'])
    ->name('paiement.webhook');

// Page status par transaction
Route::get('/paiement/status/{transaction}', [PaiementInscriptionController::class, 'status'])
    ->name('paiement.status');

// Page succès
Route::get('/paiement/success', [PaiementInscriptionController::class, 'success'])
    ->name('paiement.success');

// Page échec
Route::get('/paiement/failed', function () {
    return view('frontend.pages.paiement-failed');
})->name('paiement.failed');

// Paiement flexible — continuer avec son code
Route::get('/paiement/continuer', [PaiementInscriptionController::class, 'showContinuerForm'])
    ->name('paiement.continuer');
Route::post('/paiement/continuer/recherche', [PaiementInscriptionController::class, 'rechercherDossier'])
    ->name('paiement.continuer.recherche');
Route::get('/paiement/continuer/{token}', [PaiementInscriptionController::class, 'showDossier'])
    ->name('paiement.continuer.dossier');
Route::post('/paiement/continuer/{token}/payer', [PaiementInscriptionController::class, 'processContinuer'])
    ->name('paiement.continuer.process');



Route::get('/paiement/callback', [PaiementInscriptionController::class, 'callback'])
    ->name('paiement.callback');


Route::get('/paiement/{paiement}/download', [PaiementInscriptionController::class, 'download'])
    ->name('paiement.download');

Route::get('/paiement/{paiement}/download-dossier', [PaiementInscriptionController::class, 'downloadDossier'])
    ->name('paiement.download.dossier');

Route::get('/paiement/tranche/{tranche}/download', [PaiementInscriptionController::class, 'downloadTranche'])
    ->name('paiement.tranche.download');

Route::get('/circonscriptions/by-departement/{id}', [App\Http\Controllers\PaiementInscriptionController::class, 'getCirconscriptions']);
Route::get('/formations/by-district/{id}', [App\Http\Controllers\PaiementInscriptionController::class, 'getFormations']);
Route::get('/regions/by-province/{id}', [App\Http\Controllers\PaiementInscriptionController::class, 'getRegions']); // <-- note le "s" à regions


Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/service', [FrontendController::class, 'services'])->name('service');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group([
    "middleware" => ["auth", "auth.administrateur"],
    'as' => 'administrateur.'
], function () {

    // ================= DASHBOARD =================
    Route::get(
        'dashboard',
        [App\Http\Controllers\DashboardController::class, 'index']
    )->name('dashboard');

    // ================= GESTION UTILISATEURS =================
    Route::group([
        "prefix" => "gestutilisateurs",
        "as" => "gestutilisateurs."
    ], function () {

        Route::get("/utilisateurs", Utilisateurs::class)
            ->name("users.index");
    });

  Route::group([
        "prefix" => "gestinscriptions",
        "as" => "gestinscriptions."
    ], function () {

        // Liste et actions existantes
        Route::get('/', [PaiementController::class, 'index'])->name('inscriptions.index');
        Route::get('/export/pdf', [PaiementController::class, 'exportPdf'])->name('inscriptions.export.pdf');
        Route::get('/export/comptable', [PaiementController::class, 'exportComptablePdf'])->name('inscriptions.export.comptable');
        Route::get('/export/excel', [PaiementController::class, 'exportExcel'])->name('inscriptions.export.excel');
        Route::get('/export/csv', [PaiementController::class, 'exportCsv'])->name('inscriptions.export.all.csv');
        Route::get('/{id}/pdf', [PaiementController::class, 'exportSinglePdf'])->name('inscriptions.export.single.pdf');
        Route::get('/{id}', [PaiementController::class, 'show'])->name('inscriptions.show');
        Route::delete('/{id}', [PaiementController::class, 'destroy'])->name('inscriptions.destroy');
        Route::post('/{id}/status', [PaiementController::class, 'changeStatus'])->name('changeStatus');

        // ================= SUPPRIMER TOUTES LES INSCRIPTIONS =================
        Route::delete('/destroy-all', [PaiementController::class, 'destroyAll'])->name('inscriptions.destroyAll');

        Route::delete('/gestinscriptions/destroy-selected', [PaiementController::class, 'destroySelected'])
    ->name('inscriptions.destroySelected');
    });

    Route::group([
        "prefix" => "gestparametres",
        'as' => 'gestparametres.'
    ], function () {
        Route::get('/', [App\Http\Controllers\ParametreController::class, 'index'])->name('parametres.index');
        Route::post('parametres', [App\Http\Controllers\ParametreController::class, 'store'])->name('parametres.store');
    });
});
Route::group([
    "middleware" => ["auth", "auth.employer"],
    'as' => 'employer.'
], function () {



    Route::group([
        "prefix" => "gestoptions",
        'as' => 'gestoptions.'
    ], function () {
        Route::get('/', [App\Http\Controllers\OptionController::class, 'index'])->name('options.index');
        Route::get('/create', [App\Http\Controllers\OptionController::class, 'create'])->name('options.create');
        Route::post('/store', [App\Http\Controllers\OptionController::class, 'store'])->name('options.store');
        Route::get('/{option}/edit', [App\Http\Controllers\OptionController::class, 'edit'])->name('options.edit');
        Route::put('/{option}', [App\Http\Controllers\OptionController::class, 'update'])->name('options.update');
        Route::delete('/{option}', [App\Http\Controllers\OptionController::class, 'destroy'])->name('options.destroy');

        Route::post('/{option}/toggle-statut', [App\Http\Controllers\OptionController::class, 'toggleStatut'])
            ->name('options.toggleStatut');
    });
    Route::group([
        "prefix" => "gestabouts",
        'as' => 'gestabouts.'
    ], function () {
        Route::get('/', [App\Http\Controllers\AboutController::class, 'index'])->name('abouts.index');
        Route::get('/create', [App\Http\Controllers\AboutController::class, 'create'])->name('abouts.create');
        Route::post('/store', [App\Http\Controllers\AboutController::class, 'store'])->name('abouts.store');
        Route::get('/{about}/edit', [App\Http\Controllers\AboutController::class, 'edit'])->name('abouts.edit');
        Route::put('/{about}', [App\Http\Controllers\AboutController::class, 'update'])->name('abouts.update');
        Route::delete('/{about}', [App\Http\Controllers\AboutController::class, 'destroy'])->name('abouts.destroy');
    });

    Route::group([
        "prefix" => "gestservices",
        'as' => 'gestservices.'
    ], function () {
        Route::get('/', [App\Http\Controllers\ServiceController::class, 'index'])->name('services.index');
        Route::get('/create', [App\Http\Controllers\ServiceController::class, 'create'])->name('services.create');
        Route::post('/store', [App\Http\Controllers\ServiceController::class, 'store'])->name('services.store');
        Route::get('/{service}/edit', [App\Http\Controllers\ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/{service}', [App\Http\Controllers\ServiceController::class, 'update'])->name('services.update');
        Route::delete('/{service}', [App\Http\Controllers\ServiceController::class, 'destroy'])->name('services.destroy');
    });

    Route::group([
        "prefix" => "gestgaleries",
        'as' => 'gestgaleries.'
    ], function () {

        Route::get('/', [App\Http\Controllers\GalerieController::class, 'index'])->name('galeries.index');
        Route::get('/create', [App\Http\Controllers\GalerieController::class, 'create'])->name('galeries.create');
        Route::post('/create', [App\Http\Controllers\GalerieController::class, 'store'])->name('galeries.store');
        Route::get('/edit/{galerie}', [App\Http\Controllers\GalerieController::class, 'edit'])->name('galeries.edit');
        Route::put('/update/{galerie}', [App\Http\Controllers\GalerieController::class, 'update'])->name('galeries.update');
        Route::delete('/delete/{galerie}', [App\Http\Controllers\GalerieController::class, 'destroy'])->name('galeries.destroy');

        Route::post('/toggle-statut/{galerie}', [App\Http\Controllers\GalerieController::class, 'toggleStatut'])
            ->name('galeries.toggle-statut');
    });
});
