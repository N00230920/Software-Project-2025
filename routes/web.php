<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;

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

Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');
Route::get('/plants/create', [PlantController::class, 'create'])->name('plants.create');
Route::get('/plants/{plant}', [PlantController::class, 'show'])->name('plants.show');
Route::post('/plants', [PlantController::class, 'store'])->name('plants.store');
Route::get('/plants/{plant}/edit', [PlantController::class, 'edit'])->name('plants.edit');
Route::put('/plants/{plant}', [PlantController::class, 'update'])->name('plants.update');
Route::delete('/plants/{plant}', [PlantController::class, 'destroy'])->name('plants.destroy');


Route::resource('notes', NoteController::class);
Route::post('plants/{plant}/notes', [PlantController::class,'store'])->name('notes.store');
require __DIR__.'/auth.php';
