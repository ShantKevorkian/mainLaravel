<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UpdateController;


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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/detail', [UpdateController::class, 'update'])->name('detail.update');
Route::put('/profile/avatar', [ImageController::class, 'upload'])->name('avatar.upload');
Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/posts/{id}', function ($id) {
    return view('editPost',['post' => Post::where('id' ,$id)->first()]);
})->name('post.edit');
Route::put('/posts/update/{id}', [PostController::class, 'update'])->name('post.update');
