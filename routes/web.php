<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     Route::get('/menu', [MenuController::class, 'index'])->name('menu');
//     Route::post('/menu', [MenuController::class, 'store']);
//     Route::get('/menu/create', [MenuController::class, 'create']);
// });

// require __DIR__.'/auth.php';

foreach (scandir($path = app_path('Http\Module')) as $dir) {
    if (file_exists($filepath = "{$path}/{$dir}/Presentation/routes/web.php")) {
        require $filepath;
    }
}
