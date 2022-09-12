<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

use App\Http\Controllers\GenreController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\QualityController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/dashboard/home', [HomeController::class, 'index'])->name('home');

    //config

    Route::get('/dashboard/config',[GenreController::class,'index'])->name('config');
    // User Management
    Route::get('/user/datatable/ssd', [UserController::class, 'ssd'])->name('user.ssd');
    Route::resource('/user', UserController::class);

    //Genre Management
    Route::get('/genre/datatable/ssd', [GenreController::class, 'ssd'])->name('genre.ssd');
    Route::resource('/genre', GenreController::class);

    //Server Management
    Route::get("/server/datatable/ssd",[ServerController::class,'ssd'])->name('server.ssd');
    Route::resource('/server', ServerController::class);

   // quality
    Route::get('/quality/datable/ssd',[QualityController::class,'ssd'])->name("quality.ssd");
    Route::resource('/quality', QualityController::class);
});

Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
