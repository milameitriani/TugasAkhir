<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\Admin\CategoryController;
use App\Http\Controllers\Ajax\Admin\NotificationController;

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

Route::group(['middleware' => 'auth:admin'], function ()
{
    Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('notifications');
});