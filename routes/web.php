<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\certificationController;
use App\Http\Controllers\educationController;
use App\Http\Controllers\experienceController;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\halamanController;
use App\Http\Controllers\interestController;
use App\Http\Controllers\pengaturanHalamanController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\skillController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Support\Facades\Socialite;

Route::get('/',[frontendController::class, "index"]);

Route::redirect('home', 'dashboard');

// Fitur Otentikasi Sosial Media (Google Socialite)
Route::get('/auth', [authController::class, "index"])->name('login')->middleware('guest');
Route::get('/auth/redirect', [authController::class, "redirect"])->middleware('guest');
Route::get('/auth/callback', [authController::class, "callback"])->middleware('guest');
Route::get('/auth/logout', [authController::class, "logout"]);

// Grup Area Dashboard Admin (Proteksi Middleware Auth)
Route::prefix('dashboard')->middleware('auth')->group(
    function () {
        // PERBAIKAN: Menghapus duplikasi rute dashboard root. 
        // Sekarang, saat admin mengakses url '/dashboard', langsung ditangani oleh index halaman.
        Route::get('/', [halamanController::class, 'index']);        
        // Rute Resource Otomatis (CRUD) untuk menu standar
        Route::resource('halaman', halamanController::class);
        Route::resource('experience', experienceController::class);
        Route::resource('education', educationController::class);
        Route::resource('project', projectController::class);
        Route::resource('certification', certificationController::class);

        Route::get('skill', [skillController::class, "index"])->name('skill.index');
        Route::put('skill', [skillController::class, "update"])->name('skill.update');

        Route::get('profile', [profileController::class, "index"])->name('profile.index');
        Route::put('profile', [profileController::class, "update"])->name('profile.update');

        Route::get('pengaturanhalaman', [pengaturanHalamanController::class, "index"])->name('pengaturanhalaman.index');
        Route::put('pengaturanhalaman', [pengaturanHalamanController::class, "update"])->name('pengaturanhalaman.update');

        Route::get('interest', [interestController::class, 'index'])->name('interest.index');
        Route::put('interest', [interestController::class, 'update'])->name('interest.update');
    }
);