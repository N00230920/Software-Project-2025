<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\PlantUserController;

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

Route::resource('plants', PlantController::class);
Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');
Route::get('/plants/create', [PlantController::class, 'create'])->name('plants.create');
Route::get('/plants/{plant}', [PlantController::class, 'show'])->name('plants.show');
Route::post('/plants', [PlantController::class, 'store'])->name('plants.store');
Route::get('/plants/{plant}/edit', [PlantController::class, 'edit'])->name('plants.edit');
Route::put('/plants/{plant}', [PlantController::class, 'update'])->name('plants.update');
Route::delete('/plants/{plant}', [PlantController::class, 'destroy'])->name('plants.destroy');


Route::resource('notes', NoteController::class);
Route::post('/plants/{plant}/notes', [NoteController::class,'store'])->name('notes.store');


Route::resource("maintenance", MaintenanceController::class);
Route::get('/index', [PlantUserController::class, 'index'])->name('maintenance.index');
Route::post('/maintenance', [MaintenanceController::class,'store'])->name('maintenance.store');


Route::resource('plant-user', PlantUserController::class);
Route::get('/index', [PlantUserController::class, 'index'])->name('plantuser.index');
Route::get('/search-plant-user', [PlantUserController::class, 'searchPlantUser'])->middleware('auth');
Route::get('/plantuser/{id}', [PlantUserController::class, 'show'])->name('plantuser.show');
Route::post('plantuser/store/{plant}', [PlantUserController::class, 'store'])->name('plantuser.store');
Route::get('/plantuser/add/{plant}', [PlantUserController::class, 'create'])->name('plantuser.add');
Route::get('/plantuser/{plantUser}/edit', [PlantUserController::class, 'edit'])->name('plantuser.edit');
Route::put('/plantuser/{id}', [PlantUserController::class, 'update'])->name('plantuser.update');
Route::delete('/plantuser/{id}', [PlantUserController::class, 'destroy'])->name('plantuser.destroy');



require __DIR__.'/auth.php';
