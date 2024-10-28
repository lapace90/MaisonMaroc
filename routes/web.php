<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReservationController;

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

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Route pour la page de connexion
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Groupe de routes pour l'administration
Auth::routes();
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/home', [HomeController::class, 'indexAdmin'])->name('admin.home'); // Renommé ici
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('menus', MenuController::class);
    Route::get('menus/{id}/edit', [MenuController::class, 'edit'])->name('menus.edit'); // pour afficher le formulaire d'édition
    Route::put('menus/{id}', [MenuController::class, 'update'])->name('menus.update'); // pour mettre à jour le menu
    Route::delete('/menus/{id}', [MenuController::class, 'destroy'])->name('menus.destroy');
    Route::resource('activities', ActivityController::class);
    Route::put('/activities/{id}', [ActivityController::class, 'update'])->name('activities.update');
    Route::delete('/activities/{id}', [ActivityController::class, 'destroy'])->name('activities.destroy');
    Route::get('agenda', [AgendaController::class, 'index'])->name('admin.agenda.index'); // Ajouter la route pour l'agenda

    // Routes pour les réservations
    Route::get('reservations/list', [ReservationController::class, 'reservationList'])->name('reservations.list');
    Route::resource('reservations', ReservationController::class);
    Route::get('reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

    // Routes pour les brouillons
    Route::resource('drafts', DraftController::class);
    Route::post('drafts/menu', [DraftController::class, 'storeMenuDraft'])->name('drafts.storeMenuDraft');
    Route::post('drafts/activity', [DraftController::class, 'storeActivityDraft'])->name('drafts.storeActivityDraft');
    Route::put('drafts/{draft}', [DraftController::class, 'update'])->name('drafts.update');
    Route::delete('drafts/{draft}', [DraftController::class, 'destroy'])->name('drafts.destroy');
});
