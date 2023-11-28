<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TypeController;
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
    return view('dashboard');
});

Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

Route::get('/profile', [ProfileController::class, 'edit'])->middleware(['auth'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->middleware(['auth'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware(['auth'])->name('profile.destroy');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::post('/menu', [MenuController::class, 'store'])->middleware(['auth']);
Route::get('/menu/create', [MenuController::class, 'create'])->middleware(['auth', 'admin']);
Route::get('/menu/{id}', [MenuController::class, 'show'])->middleware(['auth'])->name('menu.show');
Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])->middleware(['auth', 'admin']);
Route::put('/menu/{id}', [MenuController::class, 'update'])->middleware(['auth']);
Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->middleware(['auth']);

Route::get('/type', [TypeController::class, 'index'])->middleware(['auth'])->name('type');
Route::post('/type', [TypeController::class, 'store'])->middleware(['auth']);
Route::get('/type/create', [TypeController::class, 'create'])->middleware(['auth', 'admin']);
Route::get('/type/{id}/edit', [TypeController::class, 'edit'])->middleware(['auth', 'admin']);
Route::put('/type/{id}', [TypeController::class, 'update'])->middleware(['auth']);
Route::delete('/type/{id}', [TypeController::class, 'destroy'])->middleware(['auth']);

Route::post('/menu/{id}', [ReviewController::class, 'store'])->middleware(['auth'])->name('review.create');

Route::get('/cart', [CartController::class, 'index'])->middleware(['auth'])->name('cart');
Route::post('/cart', [CartController::class, 'store'])->middleware(['auth'])->name('cart.create');
Route::get('/cart/{id}', [CartController::class, 'delete'])->middleware(['auth']);
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->middleware(['auth']);
Route::put('/cart', [CartController::class, 'update'])->middleware(['auth'])->name('cart.update');

Route::get('/order', [OrderController::class, 'index'])->middleware(['auth'])->name('order');
Route::post('/order', [OrderController::class, 'store'])->middleware(['auth']);
Route::get('/order/create', [OrderController::class, 'create'])->middleware(['auth']);
Route::post('/order/take/{id}', [OrderController::class, 'take'])->middleware(['auth'])->name('order.take');
Route::post('/order/done/{id}', [OrderController::class, 'done'])->middleware(['auth'])->name('order.done');

Route::get('/user', [UserController::class, 'index'])->middleware(['auth', 'admin'])->name('user');
Route::post('/user', [UserController::class, 'store'])->middleware(['auth', 'admin']);
Route::get('/user/create', [UserController::class, 'create'])->middleware(['auth', 'admin']);
Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware(['auth', 'admin']);

Route::get('/promo', [PromoController::class, 'index'])->name('promo');
Route::post('/promo', [PromoController::class, 'store'])->middleware(['auth']);
Route::get('/promo/create', [PromoController::class, 'create'])->middleware(['auth', 'admin']);

require __DIR__ . '/auth.php';
