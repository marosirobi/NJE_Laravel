<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KapcsolatController;
use App\Http\Controllers\UzenetController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdatbazisController;
use App\Http\Controllers\Admin\VarosCRUDController;
use App\Models\Lelekszam;

use App\Http\Controllers\DiagramController;

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

Route::get('/adatbazis', [AdatbazisController::class, 'index'])
     ->middleware('auth')
     ->name('adatbazis.index');

Route::resource('admin/varosok', VarosCRUDController::class)
     ->middleware(['auth', 'admin'])
     ->names('admin.varosok');

Route::post('admin/varosok/{varosok}/lelekszam', [VarosCRUDController::class, 'storeLelekszam'])
     ->middleware(['auth', 'admin'])->name('admin.varosok.lelekszam.store');

// Lélekszám adat törlése
Route::delete('admin/lelekszam/{varosid}/{ev}', [VarosCRUDController::class, 'destroyLelekszam'])
     ->middleware(['auth', 'admin'])->name('admin.lelekszam.destroy');



// ... a többi routed fölött/alatt bárhol lehet

Route::get('/diagram', [DiagramController::class, 'index'])
    ->name('diagram.index');

require __DIR__.'/auth.php';


Route::get('/run-migrations', function () {
    return Artisan::call('migrate:fresh', ["--seed" => true, "--force" => true]);
});