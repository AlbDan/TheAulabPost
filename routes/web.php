<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;

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

// Public routes-----------------
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

// User routes-------------------
Route::get('/my-profile', [UserController::class, 'myProfile'])->name('myProfile');
Route::get('/my-profile/modify-profile', [UserController::class, 'modMyProfile'])->name('modMyProfile');
Route::get('/twoFA', [UserController::class, 'twoFA'])->name('twoFA');


// Article routes----------------
// CREATE
Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');
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

