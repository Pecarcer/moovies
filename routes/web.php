<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserReviewController;
use App\Http\Controllers\MovieController;

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

Route::get('/configuracion',[UserController::class, 'config'])->name('config'); //para cambiar nuestro usuario
Route::post('/user/update',[UserController::class, 'update'])->name('user.update'); //para hacer update de nuestro usuario
Route::get('/profile',[UserController::class, 'profile'])->name('profile'); //para cambiar nuestro usuario

Route::get('/user/avatar/{filename}',[UserController::class, 'getImage'])->name('user.avatar'); //para acceder al avatar de un usuario

Route::get('/reviews',[ReviewController::class, 'admin'])->name('review.admin'); //para administrar reseñas
Route::post('/review/save',[ReviewController::class, 'save'])->name('review.save'); //para guardar reseña

Route::get('/users',[UserController::class, 'admin'])->name('user.admin');//para administrar usuarios
Route::post('/user/save',[UserController::class, 'save'])->name('user.save');//para guardar usuarios

Route::get('/movies',[MovieController::class, 'admin'])->name('movie.admin');//para administrar pelis
Route::post('/movie/save',[MovieController::class, 'save'])->name('movie.save');//para guardar pelis

Route::get('/movie/poster/{filename}',[MovieController::class, 'getImage'])->name('movie.poster'); //para acceder al avatar de un usuario

Route::get('/likes',[UserReviewController::class, 'admin'])->name('likes.admin');//para administrar los likes
Route::post('/likes/save',[UserReviewController::class, 'save'])->name('likes.save');//para guardar likes





require __DIR__.'/auth.php';
