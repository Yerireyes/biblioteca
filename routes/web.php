<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SemesterController;
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
    return view("welcome");
});

Route::get('/prueba', function () {
    return view("index");
});

Auth::routes();
Route::resource('roles',RolController::class);
Route::resource('documents',DocumentController::class);
Route::resource('users',UserController::class);
Route::resource('authors',AuthorController::class);
Route::resource('languages',LanguageController::class);
Route::resource('editorials',EditorialController::class);
Route::resource('subjects',SubjectController::class);
Route::resource('semesters',SemesterController::class);
Route::get('/cover_Page/{documentId}',[App\Http\Controllers\HomeController::class, 'coverPage'])->name('cover_Page');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/myreg', [App\Http\Controllers\UserController::class, 'register'])->name('myreg');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
