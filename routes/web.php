<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/configuracion',[UserController::class, 'config'])->name('config');
Route::post('/user/update',[UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}',[UserController::class, 'getImage'])->name('user.avatar');





require __DIR__.'/auth.php';
