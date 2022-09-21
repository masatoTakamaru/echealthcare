<?php

use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use App\Http\Controllers\User\Auth\ConfirmablePasswordController;
use App\Http\Controllers\User\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\User\Auth\EmailVerificationPromptController;
use App\Http\Controllers\User\Auth\NewPasswordController;
use App\Http\Controllers\User\Auth\PasswordResetLinkController;
use App\Http\Controllers\User\Auth\RegisteredUserController;
use App\Http\Controllers\User\Auth\VerifyEmailController;
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

Route::get('/', 'App\Http\Controllers\IndexController@index')
    ->name('index');

Route::get('cateogry/{cat_id}/{subcat_id?}', 'App\Http\Controllers\CatController@index')
    ->name('category');

Route::get('{id}/single', 'App\Http\Controllers\SingleController@index')
    ->name('single');

Route::resource('/cart', 'App\Http\Controllers\CartController');

Route::resource('/favorite', 'App\Http\Controllers\FavoriteController')
    ->only(['index', 'store', 'destroy']);

Route::get('search', 'App\Http\Controllers\SearchController@index')
    ->name('search');

Route::get('search', 'App\Http\Controllers\SearchController@search')
    ->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', 'App\Http\Controllers\CheckoutController@index')
        ->name('checkout');
    Route::post('/checkout', 'App\Http\Controllers\CheckoutController@succeed')
        ->name('checkout.succeed');
    Route::resource('user', 'App\Http\Controllers\UserController')
        ->only(['edit', 'update', 'destroy']);
    Route::get('user', 'App\Http\Controllers\UserController@updatesucceed')
        ->name('updatesucceed');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:users')
    ->name('logout');
