<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\IndexController@index')->name('index');
Route::get('cateogry/{cat_id}/{catsub_id?}', 'App\Http\Controllers\CatController@index')->name('category');
Route::get('{id}/single', 'App\Http\Controllers\SingleController@index')->name('single');
Route::resource('/cart', 'App\Http\Controllers\CartController');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@index')->name('checkout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

