<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\Profession;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DetailController;


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

Route::get('/home', [FeedController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/{guest}', [ProfileController::class, 'show'])->name('profile.guest');
Route::put('/profile/detail', [DetailController::class, 'update'])->name('detail.update');
Route::put('/profile/avatar', [ImageController::class, 'upload'])->name('avatar.upload');
Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/posts/{post}',[PostController::class, 'showUpdate'])->name('post.edit');
Route::put('/posts/update/{id}', [PostController::class, 'update'])->name('post.update');
Route::get("post/new",[PostController::class, 'showNewPost'])->name("post.new");
Route::post("post/create",[PostController::class,"create"])->name('post.create');
Route::get('/posts/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
Route::get('/posts/{post}/detail',[PostController::class, 'postDetail'])->name('post.detail');
Route::resource('gallery',GalleryController::class);
Route::delete('gallery/delete/{gallery}/{id}/',[GalleryController::class,'deleteImage'])->name('gallery.deleteImage');
