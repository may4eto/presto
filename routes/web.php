<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RevisorRequestController;

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

// Entità
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/show', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}/update', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}/delete', [PostController::class, 'destroy'])->name('posts.destroy');

//CATEGORY PAGES
Route::get('/categories/{category}/index', [CategoryController::class, 'index'])->name('categories.index');

//SEARCH
Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');

//LOCALIZATION
Route::post('/locale/{locale}', [HomeController::class, 'locale'])->name('locale');

//images 
Route::post('/posts/images/upload', [PostController::class, 'uploadImage'])->name('posts.images.upload');
Route::delete('/posts/images/remove', [PostController::class, 'removeImage'])->name('posts.images.remove');
Route::get('/posts/images', [PostController::class, 'getImages'])->name('posts.images');
//images db
Route::delete('/posts/image/{image}/delete', [PostController::class, 'destroyImage'])->name('posts.image.delete');

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [PostController::class, 'search'])->name('posts.search');

//Rotte per il revisore
Route::get('/revisor/index', [RevisorController::class, 'index'])->name('revisor.index');
Route::post('/revisor/post/{id}/accept', [RevisorController::class, 'accept'])->name('revisor.accept');
Route::post('/revisor/post/{id}/reject', [RevisorController::class, 'reject'])->name('revisor.reject');

// Rotte utente
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::post('/user/{id}/add/favourite', [UserController::class, 'favouriteStore'])->name('user.add.favourite');
Route::delete('/user/{id}/remove/favourite', [UserController::class, 'favouriteRemove'])->name('user.remove.favourite');


//Rotta richiedere di essere revisor
Route::post('/user/profile/revisor_request', [RevisorRequestController::class, 'store'])->name('requests.store');

//Rotta Admin
Route::get('/user/admin/profile', [AdminController::class, 'index'])->name('admin.profile');
Route::post('/user/admin/{id}/accept', [AdminController::class, 'accept'])->name('admin.accept');
Route::post('/user/admin/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');