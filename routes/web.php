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
    Route::get('rooms/{room}/teachers', [\App\Http\Controllers\Admin\RoomController::class, 'teachers'])->name('rooms.teachers');
    Route::put('rooms/{room}/teachers', [\App\Http\Controllers\Admin\RoomController::class, 'addTeacher'])->name('rooms.teachers.store');
    Route::delete('rooms/{room}/teachers', [\App\Http\Controllers\Admin\RoomController::class, 'removeTeacher'])->name('rooms.teachers.remove');

    Route::get('rooms/{room}/subjects', [\App\Http\Controllers\Admin\RoomController::class, 'subjects'])->name('rooms.subjects');
    Route::put('rooms/{room}/subjects', [\App\Http\Controllers\Admin\RoomController::class, 'addSubject'])->name('rooms.subjects.store');
    Route::delete('rooms/{room}/subjects', [\App\Http\Controllers\Admin\RoomController::class, 'removeSubject'])->name('rooms.subjects.remove');

    Route::resource('rooms', \App\Http\Controllers\Admin\RoomController::class);

    //Teacher Routes
    Route::resource('teachers', \App\Http\Controllers\Admin\TeacherController::class);

    //Subject Routes
    Route::resource('subjects', \App\Http\Controllers\Admin\SubjectController::class);

     //Parent Routes
     Route::resource('parents', \App\Http\Controllers\Admin\ParentsController::class);

     //Student Routes
    Route::resource('students', \App\Http\Controllers\Admin\StudentController::class);

});
