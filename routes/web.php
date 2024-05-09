<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', function () {
    return view('home_page');
});

Route::get('/p_page',function(){
    return view('pyramic_page');
});
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// router product
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('store_products');
Route::get('/products/add', [App\Http\Controllers\ProductController::class, 'addform'])->name('addform');
Route::get('/products/detail', [App\Http\Controllers\ProductController::class, 'products'])->name('productsDetail');



// router Categories
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');



Route::get('/website', [App\Http\Controllers\WebsiteController::class, 'index'])->name('website');


// router test 
Route::post('/test', [App\Http\Controllers\ProductController::class, 'test'])->name('test');