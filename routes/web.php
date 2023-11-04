<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TypeController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::post('/menu', [MenuController::class, 'store']);
    Route::get('/menu/create', [MenuController::class, 'create']);
    Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
    Route::get('/menu/{id}/edit', [MenuController::class, 'edit']);
    Route::put('/menu/{id}', [MenuController::class, 'update']);
    Route::delete('/menu/{id}', [MenuController::class, 'destroy']);
    
    Route::get('/type', [TypeController::class, 'index'])->name('type');
    Route::post('/type', [TypeController::class, 'store']);
    Route::get('/type/create', [TypeController::class, 'create']);
    Route::get('/type/{id}/edit', [TypeController::class, 'edit']);
    Route::put('/type/{id}', [TypeController::class, 'update']);
    Route::delete('/type/{id}', [TypeController::class, 'destroy']);

    Route::post('/menu/{id}', [ReviewController::class,'store'])->name('review');
});

require __DIR__ . '/auth.php';
