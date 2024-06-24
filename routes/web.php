<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\auth\AuthenticatedSessionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\RequeteController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

// Route::get('/', function () {
//     return view('home');
// });

Route::get('account', [AuthenticatedSessionController::class, 'createAccount'])->name('addAccount');
Route::post('account', [AuthenticatedSessionController::class, 'addAccount'])->name('AddAccount');

Route::get('account1', [AuthenticatedSessionController::class, 'createAccount1'])->name('addAccount1');
Route::post('account1', [AuthenticatedSessionController::class, 'addAccount1'])->name('AddAccount1');

Route::get('account2', [AuthenticatedSessionController::class, 'createAccount2'])->name('addAccount2');
Route::post('account2', [AuthenticatedSessionController::class, 'addAccount2'])->name('AddAccount2');

Route::get('Create', [AuthenticatedSessionController::class, 'account'])->name('compte');
Route::post('Create', [AuthenticatedSessionController::class, 'addCompt'])->name('addCompt');

Route::get('bureau', [UserController::class, 'AffichageStruct'])->name('Affichage');
Route::post('bureau', [UserController::class, 'store'])->name('addStruct');

Route::get('role', [UserController::class, 'AffichageRole'])->name('Affichage');
Route::post('role', [UserController::class, 'storeRole'])->name('addRole');

Route::get('newType', [TypeController::class, 'Create'])->name('createType');
Route::post('newType', [TypeController::class, 'storeType'])->name('addType');

Route::get('newSchema', [TypeController::class, 'CreateSchema'])->name('createSchema');
Route::post('newSchema', [TypeController::class, 'storeSchema'])->name('addSchema');

Route::get('type', [TypeController::class, 'Affichage'])->name('viewType');
Route::get('Stype', [TypeController::class, 'studentAffichage'])->name('view');

Route::get('req', [RequeteController::class, 'addReq'])->name('addReq');
Route::post('req', [RequeteController::class, 'storeReq'])->name('addReq');

Route::get('allReq', [RequeteController::class, 'allReq'])->name('allReq');

Route::get('Requetes', [RequeteController::class, 'Requete'])->name('requete');
Route::get('Traitement', [RequeteController::class, 'Traitement'])->name('traitement');
Route::get('image/{id}', [RequeteController::class, 'show'])->name('image.show');


Route::post('/valider/{id}',[RequeteController::class,'Valider'])->name('valider');
Route::post('/refuser/{id}',[RequeteController::class,'Refuser'])->name('refuser');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/backend.php';
