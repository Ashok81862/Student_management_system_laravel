<?php

use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [\App\Http\Controllers\SiteController::class, 'home'])->middleware('auth');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function (){
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index']);

    //Users Routes
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    //Room Routes
    Route::resource('rooms', \App\Http\Controllers\Admin\RoomController::class);

    //Teacher Routes
    Route::resource('teachers', \App\Http\Controllers\Admin\TeacherController::class);

    //Subject Routes
    Route::resource('subjects', \App\Http\Controllers\Admin\SubjectController::class);

     //Parent Routes
     Route::resource('parents', \App\Http\Controllers\Admin\ParentsController::class);

});
