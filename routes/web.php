<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\TechnicienController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AffectationController;
use App\Http\Controllers\HistoriqueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard')->middleware('auth');

Route::get('/technicien/dashboard', [HomeController::class, 'indexx'])->name('technicien.dashboard')->middleware('auth');


// Route::resource('stocks', StockController::class);

/******************************ADMIN****************************** */

/******************************STOCKS****************************** */
Route::get('/admin/stocks', [\App\Http\Controllers\StockController::class, 'index'])->name('stocks.index');
Route::get('/admin/stocks/create', [StockController::class, 'create'])->name('admin.stocks.create');
Route::post('/admin/stocks', [StockController::class, 'store'])->name('admin.stocks.store');
Route::get('/admin/stocks/{id}/edit', [StockController::class, 'edit'])->name('admin.stocks.edit');
Route::put('/admin/stocks/{id}', [StockController::class, 'update'])->name('admin.stocks.update');
Route::delete('/admin/stocks/{stock}', [StockController::class, 'destroy'])->name('admin.stocks.destroy');
Route::get('/admin/stocks/export/pdf', [StockController::class, 'exportPdf'])->name('admin.stocks.export.pdf');
Route::get('/admin/stocks/export/excel', [StockController::class, 'exportExcel'])->name('admin.stocks.export.excel');
/******************************STOCKS****************************** */

Route::middleware('auth')->group(function () {
    // Afficher tous les équipements
    Route::get('equipements', [EquipementController::class, 'index'])->name('equipements.index');

    // Formulaire de création d'équipement
    Route::get('equipements/create', [EquipementController::class, 'create'])->name('admin.equipements.create');

    // Enregistrer un nouvel équipement
    Route::post('equipements', [EquipementController::class, 'store'])->name('equipements.store');

    // Afficher un équipement spécifique
    Route::get('equipements/{equipement}', [EquipementController::class, 'show'])->name('equipements.show');

    // Formulaire de modification d'un équipement
    Route::get('equipements/{equipement}/edit', [EquipementController::class, 'edit'])->name('admin.equipements.edit');

    // Mettre à jour un équipement
    Route::put('/admin/equipements/{id}', [EquipementController::class, 'update'])->name('admin.equipements.update');

    // Supprimer un équipement
    Route::delete('equipements/{equipement}', [EquipementController::class, 'destroy'])->name('admin.equipements.destroy');
});
Route::get('/equipements/export/pdf', [EquipementController::class, 'exportPDF'])->name('equipements.export.pdf');
Route::get('/equipements/export/excel', [EquipementController::class, 'exportExcel'])->name('equipements.export.excel');

/******************************TECHNICIEN****************************** */


Route::get('/admin/techniciens', [\App\Http\Controllers\TechnicienController::class, 'index'])->name('techniciens.index');
Route::get('/admin/techniciens/create', [TechnicienController::class, 'create'])->name('admin.techniciens.create');
Route::post('/admin/techniciens', [TechnicienController::class, 'store'])->name('admin.techniciens.store');
Route::get('/admin/techniciens/{id}/edit', [TechnicienController::class, 'edit'])->name('admin.techniciens.edit');
Route::put('/admin/techniciens/{id}', [TechnicienController::class, 'update'])->name('admin.techniciens.update');
Route::delete('/admin/techniciens/{id}', [TechnicienController::class, 'destroy'])->name('admin.techniciens.destroy');

/******************************TECHNICIEN****************************** */
/******************************Mmebres******************************/
// Afficher tous les membres
Route::get('/members', [MemberController::class, 'index'])->name('members.index');

// Afficher le formulaire pour créer un membre
Route::get('/members/create', [MemberController::class, 'create'])->name('technicien.members.create');

// Enregistrer un nouveau membre
Route::post('/members', [MemberController::class, 'store'])->name('technicien.members.store');

// Afficher un membre spécifique
Route::get('/members/{id}', [MemberController::class, 'show'])->name('technicien.members.show');

// Afficher le formulaire pour modifier un membre
Route::get('/members/{id}/edit', [MemberController::class, 'edit'])->name('technicien.members.edit');

// Mettre à jour un membre
Route::put('/members/{id}', [MemberController::class, 'update'])->name('technicien.members.update');

// Supprimer un membre
Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('technicien.members.destroy');


Route::get('/members/{id}/equipements', [MemberController::class, 'equipements'])->name('technicien.members.equipements');

Route::get('/equipements/{id}/etat', [EquipementController::class, 'editEtat'])->name('technicien.equipements.editEtat');
Route::post('/equipements/{id}/etat', [EquipementController::class, 'updateEtat'])->name('technicien.equipements.updateEtat');

/******************************Suivi des équipements****************************** */

Route::get('/affectations', [AffectationController::class, 'index'])->name('affectations.index');
Route::get('/affectations/create/{equipement}', [AffectationController::class, 'create'])->name('technicien.affectations.create');
Route::post('/affectations', [AffectationController::class, 'store'])->name('technicien.affectations.store');



/*******************************Historique des équipements******************************************* */

Route::get('/historiques/{id}', [EquipementController::class, 'historique'])->name('historiques.index');
Route::get('/historiques/{id}/export/pdf', [HistoriqueController::class, 'exportPdf'])->name('historiques.export.pdf');
Route::get('/historiques/{id}/export/excel', [HistoriqueController::class, 'exportExcel'])->name('historiques.export.excel');
