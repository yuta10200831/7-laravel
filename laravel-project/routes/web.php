<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;

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

    Route::post('/post/delete/{id}', [BlogController::class, 'destroy'])->name('post.delete');
});

require __DIR__.'/auth.php';