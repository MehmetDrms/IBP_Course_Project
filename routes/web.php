<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\UserController@redirect')->name('home');
Route::post('login', 'App\Http\Controllers\UserController@login')->name('login');
Route::get('logout', function (){
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('/', '\App\Http\Controllers\UserController@admin')->name('dashboard');
    Route::get('categorycar', '\App\Http\Controllers\CategoryController@index')->name('categorycar');
    Route::post('addCategory', '\App\Http\Controllers\CategoryController@addCategory')->name('category.add');
    Route::post('deleteCategory', '\App\Http\Controllers\CategoryController@deleteCategory')->name('category.delete');
    Route::post('addBrand', '\App\Http\Controllers\CategoryController@addBrand')->name('brand.add');
    Route::post('brandDelete', '\App\Http\Controllers\CategoryController@deleteBrand')->name('brand.delete');
    Route::post('addModel', '\App\Http\Controllers\CategoryController@addModel')->name('model.add');
    Route::post('deleteModel', '\App\Http\Controllers\CategoryController@deleteModel')->name('model.delete');
    Route::get('products', '\App\Http\Controllers\ProductController@adminIndex')->name('products');
    Route::post('addProduct', '\App\Http\Controllers\ProductController@addProduct')->name('product.add');
});

Route::prefix('user')->name('user.')->middleware('isUser')->group(function (){
    Route::get('/', '\App\Http\Controllers\UserController@user')->name('home');
});
