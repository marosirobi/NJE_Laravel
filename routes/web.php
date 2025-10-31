<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KapcsolatController;
use App\Http\Controllers\UzenetController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FooldalController; // <-- ADD EZT A SORT A TÖBBI USE SOR ALÁ

Route::get('/', [FooldalController::class, 'index'])->name('fooldal');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ezt BÁRKI láthatja, aki be van jelentkezve (user és admin is)
Route::get('/uzenetek', [UzenetController::class, 'index'])
     ->middleware('auth') // FONTOS!
     ->name('uzenetek.index');

Route::get('/admin/dashboard', [AdminController::class, 'index'])
     ->middleware(['auth', 'admin'])
     ->name('admin.dashboard');

Route::get('/kapcsolat', [KapcsolatController::class, 'index'])->name('kapcsolat.index');
// Űrlap elküldése (POST)
Route::post('/kapcsolat', [KapcsolatController::class, 'store'])->name('kapcsolat.store');

require __DIR__.'/auth.php';
