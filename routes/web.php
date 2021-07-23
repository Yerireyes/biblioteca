<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ThesisController;
use App\Http\Controllers\NoteController;
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
Route::post('/login2',[App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::resource('roles',RolController::class);
// Route::resource('documents',DocumentController::class);
Route::resource('users',UserController::class);
Route::resource('authors',AuthorController::class);
Route::resource('languages',LanguageController::class);
Route::resource('editorials',EditorialController::class);
Route::resource('subjects',SubjectController::class);
Route::resource('managements',ManagementController::class);
Route::resource('categories',CategoryController::class);
Route::resource('theses',ThesisController::class);
Route::resource('notes',NoteController::class);
Route::get('/cover_Page/{documentId}',[App\Http\Controllers\DocumentController::class, 'coverPage'])->name('cover_Page');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home2', [App\Http\Controllers\HomeController::class, 'index2'])->name('home2');
Route::post('/myreg', [App\Http\Controllers\UserController::class, 'register'])->name('myreg');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
