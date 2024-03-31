<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;

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
Route::get('/', [BlogController::class, 'index']);

Route::resource('blogs', BlogController::class);

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [BlogController::class, 'myPage'])->name('mypage');
    Route::get('/myarticledetail/{id}', [BlogController::class, 'myArticleDetail'])->name('blogs.myarticledetail');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::post('/post/delete/{id}', [BlogController::class, 'destroy'])->name('post.delete');
});

Route::post('/blogs/{blog}/favorite', [BlogController::class, 'favorite'])->name('blogs.favorite');

Route::post('/blogs/{blog}/bookmark', [BookmarkController::class, 'store'])->name('blogs.bookmark');

Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index')->middleware('auth');

Route::resource('categories', CategoryController::class);

Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

require __DIR__.'/auth.php';