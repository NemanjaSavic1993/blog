<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ovde dohvatiti sve kategorije blogova i blogove
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('welcome');
Route::get('/post/{id?}', [App\Http\Controllers\PostController::class, 'showPost'])->name('showPost');
Route::get('/post/banned/{id?}', [App\Http\Controllers\PostController::class, 'banPost'])->name('banPost');

Auth::routes();

// treba dodati middleware da bi se zastitile rute koje su predvidjene za moderatora i administratora.

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
Route::get('/home/{id?}', [App\Http\Controllers\HomeController::class, 'editUser'])->name('admin.editUser');
Route::get('/addCategory', [App\Http\Controllers\CategoryController::class, 'addCategory'])->name('mod.addCategory');
Route::get('/category/{id?}', [App\Http\Controllers\CategoryController::class, 'editCategory'])->name('admin.editCategory');
Route::get('/addPost', [App\Http\Controllers\PostController::class, 'addPost'])->name('user.addPost');
Route::get('/editPost/{id?}', [App\Http\Controllers\PostController::class, 'editPost'])->name('user.editPost');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'updateUser'])->name('admin.updateUser');
Route::post('/storeCategory', [App\Http\Controllers\CategoryController::class, 'storeCategory'])->name('mod.storeCategory');
Route::post('/updateCategory', [App\Http\Controllers\CategoryController::class, 'updateCategory'])->name('mod.updateCategory');
Route::post('/storePost', [App\Http\Controllers\PostController::class, 'storePost'])->name('user.storePost');
Route::post('/updatePost', [App\Http\Controllers\PostController::class, 'updatePost'])->name('user.updatePost');





// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.home');

