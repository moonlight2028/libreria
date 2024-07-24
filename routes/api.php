<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthUserAPIController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});


Route::group(['prefix' => 'users', 'as' => 'users.', 'controller' => UserController::class], function () {
	Route::get('/', 'index')->name('index');
	Route::get('/{user}', 'show')->name('show');
	Route::post('/', 'store')->name('store');
	Route::put('/{user}', 'update')->name('update');
	Route::delete('/{user}', 'destroy')->name('destroy');
});


Route::group(['prefix' => 'books', 'as' => 'books.', 'controller' => BookController::class], function () {
	Route::get('/', 'index')->name('index');
	Route::get('/{book}', 'show')->name('show');
	Route::post('/', 'store')->name('store');
	Route::put('/{book}', 'update')->name('update');
	Route::delete('/{book}', 'destroy')->name('destroy');
});


Route::group(['prefix' => 'authors', 'as' => 'authors.', 'controller' => AuthorController::class], function () {
	Route::get('/', 'index')->name('index');
	Route::get('/{author}', 'show')->name('show');
	Route::post('/', 'store')->name('store');
	Route::put('/{author}', 'update')->name('update');
	Route::delete('/{author}', 'destroy')->name('destroy');
});


Route::group(['prefix' => 'categories', 'as' => 'categories.', 'controller' => CategoryController::class], function () {
	Route::get('/', 'index')->name('index');
	Route::get('/{category}', 'show')->name('show');
	Route::post('/', 'store')->name('store');
	Route::put('/{category}', 'update')->name('update');
	Route::delete('/{category}', 'destroy')->name('destroy');
});


Route::post('/login', [AuthUserAPIController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'store'])->name('register');

Route::group(['middleware' => ['auth:sanctum']], function () {
	Route::post('/logout', [AuthUserAPIController::class, 'logout'])->name('logout');
	Route::get('/profile', [AuthUserAPIController::class, 'profile'])->name('profile');
});
