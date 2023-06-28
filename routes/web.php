<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\GoogleLoginController;

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

// Public routes-----------------------------------------------------------------------------------------------
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

// Lavora con noi
Route::get('/careers', [PublicController::class, 'careers'])->middleware('auth')->name('careers');
Route::post('/careers/submit', [PublicController::class, 'careersSubmit'])->middleware('auth')->name('careers.submit');

// User routes-------------------------------------------------------------------------------------------------
Route::get('/my-profile', [UserController::class, 'myProfile'])->name('myProfile');
Route::get('/my-profile/modify-profile', [UserController::class, 'modMyProfile'])->name('modMyProfile');
Route::get('/twoFA', [UserController::class, 'twoFA'])->name('twoFA');


// Article routes----------------------------------------------------------------------------------------------

// CREATE
Route::middleware('is_writer')->group(function () {
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');
});

// READ
Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/show/{article}', [ArticleController::class, 'show'])->name('article.show');

// Article Filter (Index-Date)
Route::get('/article/by-oldest', [ArticleController::class, 'indexByOldestArticles'])->name('article.byOldest');
Route::get('/article/by-newest', [ArticleController::class, 'indexByNewestArticles'])->name('article.byNewest');

// Article Filter (Category)
Route::get('/article/category/{category}', [ArticleController::class, 'byCategory'])->name('article.byCategory');

// Article Filter (Category-Date)
Route::get('/article/category/by-oldest/{category}', [ArticleController::class, 'byCatOldestArticles'])->name('article.byCatOldest');
Route::get('/article/category/by-newest/{category}', [ArticleController::class, 'byCatNewestArticles'])->name('article.byCatNewest');

// Article Filter (Editor)
Route::get('/article/editor/{user}', [ArticleController::class, 'byEditor'])->name('article.byEditor');

// Article Filter (Editor-Date)
Route::get('/article/editor/by-oldest/{user}', [ArticleController::class, 'byEditorOldestArticles'])->name('article.byEditorOldest');
Route::get('/article/editor/by-newest/{user}', [ArticleController::class, 'byEditorNewestArticles'])->name('article.byEditorNewest');

// Article Search
Route::get('/article/search', [ArticleController::class, 'articleSearch'])->name('article.search');

// Admin Routes------------------------------------------------------------------------------------------------
Route::prefix('admin')->middleware('is_admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/{user}/set-revisor', [AdminController::class, 'setRevisor'])->name('admin.setRevisor');
    Route::get('/{user}/set-writer', [AdminController::class, 'setWriter'])->name('admin.setWriter');
    Route::get('/{user}/set-admin', [AdminController::class, 'setAdmin'])->name('admin.setAdmin');
    Route::get('/{user}/dontset-revisor', [AdminController::class, 'dontsetRevisor'])->name('admin.dontsetRevisor');
    Route::get('/{user}/dontset-writer', [AdminController::class, 'dontsetWriter'])->name('admin.dontsetWriter');
    Route::get('/{user}/dontset-admin', [AdminController::class, 'dontsetAdmin'])->name('admin.dontsetAdmin');
    Route::put('/edit/{tag}/tag', [AdminController::class, 'editTag'])->name('admin.editTag');
    Route::delete('/delete/{tag}/tag', [AdminController::class, 'deleteTag'])->name('admin.deleteTag');
    Route::put('/edit/{category}/category', [AdminController::class, 'editCategory'])->name('admin.editCategory');
    Route::delete('/delete/{category}/category', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');
    Route::post('create/category/store', [AdminController::class, 'storeCategory'])->name('admin.storeCategory');
});

// Revisor Routes----------------------------------------------------------------------------------------------
Route::middleware('is_revisor')->group(function () {
    Route::get('/revisor/dashboard', [RevisorController::class, 'dashboard'])->name('revisor.dashboard');
    Route::get('/revisor/{article}/accept', [RevisorController::class, 'acceptArticle'])->name('revisor.acceptArticle');
    Route::get('/revisor/{article}/reject', [RevisorController::class, 'rejectArticle'])->name('revisor.rejectArticle');
    Route::get('/revisor/{article}/undo', [RevisorController::class, 'undoArticle'])->name('revisor.undoArticle');
});

// Google Login------------------------------------------------------------------------------------------------

Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);