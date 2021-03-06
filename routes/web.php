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
use App\Http\Controllers\BookController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PdfController;
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
Route::post('/login',[App\Http\Controllers\UserController::class, 'login'])->name('login');
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
Route::resource('books',BookController::class);
Route::resource('logs',LogController::class);
Route::resource('pdf',PdfController::class);
Route::get('/documents/{id}/download',[App\Http\Controllers\DocumentController::class, 'download'])->name('documents.download');
Route::get('/documents_like/{id}',[App\Http\Controllers\DocumentController::class, 'like'])->name('document.like');
Route::get('/documents_disLike/{id}',[App\Http\Controllers\DocumentController::class, 'disLike'])->name('document.disLike');
Route::get('/documents_deleteLike/{id}',[App\Http\Controllers\DocumentController::class, 'deleteLike'])->name('document.deleteLike');
Route::get('/documents_deleteDislike/{id}',[App\Http\Controllers\DocumentController::class, 'deleteDislike'])->name('document.deleteDislike');
Route::get('/documents/{id}/show_Document',[App\Http\Controllers\DocumentController::class, 'showDocument'])->name('documents.show');
Route::get('/books/{id}/editorials',[App\Http\Controllers\BookController::class, 'editorialsIndex'])->name('books.editorials');
Route::post('/books/{id}/editorials',[App\Http\Controllers\BookController::class, 'editorialsCreate'])->name('books.createEditorial');
Route::delete('/books/{bookId}/editorials/{editorialId}',[App\Http\Controllers\BookController::class, 'editorialsDestroy'])->name('books.editorialsDestroy');

Route::get('/cover_Page/{documentId}',[App\Http\Controllers\DocumentController::class, 'coverPage'])->name('cover_Page');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/myreg', [App\Http\Controllers\UserController::class, 'register'])->name('myreg');

//vistas del usuario
Route::get('/books_category/{categoryId}/{superCategoryId}',[App\Http\Controllers\BookController::class, 'userIndex'])->name('books.user');
Route::get('/home2', [App\Http\Controllers\HomeController::class, 'index2'])->name('home2');
Route::get('/books_category_result', [App\Http\Controllers\HomeController::class, 'userResult'])->name('books.result');
Route::get('/forums/{documentId}', [App\Http\Controllers\ForumController::class, 'index'])->name('forums.index');
Route::get('/profilePicture/{userId}',[App\Http\Controllers\UserController::class, 'profilePicture'])->name('profile_picture');
Route::get('/forum/{id}',[App\Http\Controllers\ForumController::class, 'show'])->name('forums.show');
Route::delete('/forum/{id}',[App\Http\Controllers\ForumController::class, 'destroy'])->name('forums.delete');
Route::delete('/comment/{id}',[App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.delete');
Route::get('/forum_create/{documentId}',[App\Http\Controllers\ForumController::class, 'create'])->name('forums.create');
Route::get('/forum_edit/{documentId}',[App\Http\Controllers\ForumController::class, 'edit'])->name('forums.edit');
Route::post('/comment_update/{id}',[App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
Route::post('/forum',[App\Http\Controllers\ForumController::class, 'store'])->name('forums.store');
Route::put('/forum/{id}',[App\Http\Controllers\ForumController::class, 'update'])->name('forums.update');
Route::post('/comment',[App\Http\Controllers\ForumController::class, 'commentStore'])->name('comments.create');
Route::get('/profile/{id}',[App\Http\Controllers\UserController::class,'editProfile'])->name('user.profile');
Route::get('/profile2/{id}',[App\Http\Controllers\UserController::class,'editProfile2'])->name('user.profile2');
Route::get('/configuraciones',[App\Http\Controllers\UserController::class,'configuraciones'])->name('user.configurations');
Route::get('/configuraciones2',[App\Http\Controllers\UserController::class,'configuraciones2'])->name('user.configurations2');
Route::get('/password',[App\Http\Controllers\UserController::class,'password'])->name('user.password');
Route::get('/password2',[App\Http\Controllers\UserController::class,'password2'])->name('user.password2');
Route::post('/password_guardar',[App\Http\Controllers\UserController::class,'passwordGuardar'])->name('user.passwordGuardar');
Route::post('/password_guardar2',[App\Http\Controllers\UserController::class,'passwordGuardar2'])->name('user.passwordGuardar2');
Route::post('/configuraciones',[App\Http\Controllers\UserController::class,'configuracionesGuardar'])->name('user.update');
Route::post('/configuraciones2',[App\Http\Controllers\UserController::class,'configuracionesGuardar2'])->name('user.update2');




//reportes
Route::get('/pdfLog', [App\Http\Controllers\PdfController::class, 'indexLog'])->name('pdf.log');
Route::get('/pdfBookPopular', [App\Http\Controllers\PdfController::class, 'indexBookCatalogue'])->name('pdf.bookCatalogue');
Route::get('/pdfBookCatalogue', [App\Http\Controllers\PdfController::class, 'indexBookPopular'])->name('pdf.bookPopular');
Route::get('/pdfThesisPopular', [App\Http\Controllers\PdfController::class, 'indexThesisCatalogue'])->name('pdf.thesisCatalogue');
Route::get('/pdfThesisCatalogue', [App\Http\Controllers\PdfController::class, 'indexThesisPopular'])->name('pdf.thesisPopular');
Route::get('/pdfNotePopular', [App\Http\Controllers\PdfController::class, 'indexNoteCatalogue'])->name('pdf.noteCatalogue');
Route::get('/pdfNoteCatalogue', [App\Http\Controllers\PdfController::class, 'indexNotePopular'])->name('pdf.notePopular');
Route::post('/pdfLogCreate', [App\Http\Controllers\PdfController::class, 'storeLog'])->name('pdf.storeLog');
Route::post('/pdfBookCatalogueCreate', [App\Http\Controllers\PdfController::class, 'storeBookCatalogue'])->name('pdf.storeBookCatalogue');
Route::post('/pdfBookPopularCreate', [App\Http\Controllers\PdfController::class, 'storeBookPopular'])->name('pdf.storeBookPopular');
Route::post('/pdfThesisCatalogueCreate', [App\Http\Controllers\PdfController::class, 'storeThesisCatalogue'])->name('pdf.storeThesisCatalogue');
Route::post('/pdfThesisPopularCreate', [App\Http\Controllers\PdfController::class, 'storeThesisPopular'])->name('pdf.storeThesisPopular');
Route::post('/pdfNoteCatalogueCreate', [App\Http\Controllers\PdfController::class, 'storeNoteCatalogue'])->name('pdf.storeNoteCatalogue');
Route::post('/pdfNotePopularCreate', [App\Http\Controllers\PdfController::class, 'storeNotePopular'])->name('pdf.storeNotePopular');
Route::get('/pdfRolCreate{id}', [App\Http\Controllers\PdfController::class, 'storeRol'])->name('pdf.storeRol');
Route::get('/pdfEditorialCreate{id}', [App\Http\Controllers\PdfController::class, 'storeEditorial'])->name('pdf.storeEditorial');
Route::get('/pdfAuthorCreate{id}', [App\Http\Controllers\PdfController::class, 'storeAuthor'])->name('pdf.storeAuthor');
Route::get('/pdfLanguageCreate{id}', [App\Http\Controllers\PdfController::class, 'storeLanguage'])->name('pdf.storeLanguage');
Route::get('/pdfManagementCreate{id}', [App\Http\Controllers\PdfController::class, 'storeManagement'])->name('pdf.storeManagement');
Route::get('/pdfSubjectCreate{id}', [App\Http\Controllers\PdfController::class, 'storeSubject'])->name('pdf.storeSubject');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
