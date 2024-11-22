<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckIsAdmin;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});

Route::prefix('reviews')->group(function () {
    Route::get('/', [ReviewController::class, 'index'])->name('reviews');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ReviewController::class, 'store'])->name('reviews.store');
        Route::post('/{review}/replies', [ReplyController::class, 'store'])->name('reviews.replies.store')->middleware(CheckIsAdmin::class);
    });
});

