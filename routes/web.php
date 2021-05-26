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
Route::prefix('profile')->group(function (){
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/{guest}', [ProfileController::class, 'show'])->name('profile.guest');
    Route::put('/detail', [DetailController::class, 'update'])->name('detail.update');
    Route::put('/avatar', [ImageController::class, 'store'])->name('avatar.store');
});

Route::resources([
    'posts'   => PostController::class,
    'gallery' => GalleryController::class
]);

Route::delete('/gallery/delete/{gallery}/{id}/',[GalleryController::class,'deleteImage'])->name('gallery.deleteImage');


