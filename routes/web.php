<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\SearchController;

// Halaman awal
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// Semua route yang membutuhkan login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // CRUD Game
    Route::resource('games', GameController::class);

    // Statistik Game
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');

    // CRUD Kategori & Developer
    Route::resource('kategori', KategoriController::class)->except(['show']);
    Route::resource('developers', DeveloperController::class)->except(['show']);

    Route::delete('/logs/{log}', [\App\Http\Controllers\LogController::class, 'destroy'])->name('logs.destroy');

    Route::get('/search', [SearchController::class, 'results'])->name('search.results');


});
