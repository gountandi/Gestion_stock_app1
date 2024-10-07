<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Actions\Fortify\CreateNewUser;

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ApprovisionementController;

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

Route::resource('produits', ProduitController::class);
Route::resource('commandes', CommandeController::class);
Route::resource('clients', ClientController::class);
Route::resource('categories', CategorieController::class);
Route::resource('fournisseurs', FournisseurController::class);
Route::resource('approvisionements', ApprovisionementController::class);



Route::get("/commandes/{commande}/facture",[CommandeController::class,'generer_facture'])->name('generer_facture');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});


require __DIR__.'/auth.php';
