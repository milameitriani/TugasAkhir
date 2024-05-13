<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\{TableController, UserController};

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

Route::group(['middleware' => ['authall']], function ()
{
    Route::get('/tables/search', [TableController::class, 'search'])->name('tables.search');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
});