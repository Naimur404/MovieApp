<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [MoviesController::class,'index'])->name('movies.index');
Route::get('/movies/{movie}', [MoviesController::class,'show'])->name('movies.show');
Route::get('/tv', [TvController::class,'index'])->name('tv');
Route::get('/tv/{tv}', [TvController::class,'show'])->name('tv.show');
Route::get('/actors', [ActorController::class,'index'])->name('actors');
Route::get('/actor/page/{page}', [ActorController::class,'index']);
Route::get('/actor/{actor}', [ActorController::class,'show'])->name('actor.show');
