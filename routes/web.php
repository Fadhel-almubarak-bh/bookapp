<?php

use Illuminate\Support\Facades\Route;
use Xs4arabia\Bookapp\Http\Controllers\AuthorController;
use Xs4arabia\Bookapp\Http\Controllers\LocationController;
use Xs4arabia\Bookapp\Http\Controllers\BookController;
use Xs4arabia\Bookapp\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('vendor.bookapp.index');
});

Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
Route::resource('authors', AuthorController::class);
Route::resource('locations', LocationController::class);