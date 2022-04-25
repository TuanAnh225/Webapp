<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\PostVoteController;
use App\Http\Controllers\CommentVoteController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/posts',[PostController::class, 'index'])->name('posts');
Route::post('/posts',[PostController::class, 'store']);

Route::post('/posts/{post}/comment',[CommentController::class, 'store'])->name('posts.comment');

Route::get('/bookmarks',[BookmarkController::class, 'index'])->name('bookmarks');
Route::post('/posts/{post}/bookmark',[BookmarkController::class, 'store'])->name('posts.bookmark');

Route::post('/postsvote/{post}/{vote}',[PostVoteController::class, 'store'])->name('posts.vote');
Route::post('/unvote/{post}',[PostVoteController::class, 'destroy'])->name('posts.unvote');

Route::post('/commentvote/{comment}/{vote}',[CommentVoteController::class, 'store'])->name('comment.vote');
Route::post('/unvotecomment/{comment}',[CommentVoteController::class, 'destroy'])->name('comment.unvote');

require __DIR__.'/auth.php';
