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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [Controllers\IndexController::class, 'index'])->name('index');
Route::get('cateogry/{cat_id}/{catsub_id?}', [Controllers\CategoryController::class, 'index'])->name('category');
Route::get('{id}/single', [Controllers\SingleController::class, 'index'])->name('single');

Route::resource('/cart', 'App\Http\Controllers\CartController');
Route::get('/checkout', [Controllers\CheckoutController::class, 'index'])->name('checkout');

