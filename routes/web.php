<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\{Login, Register, LoginTable};
use App\Http\Livewire\Order\{Table as OrderTable, Cart as OrderCart, Process as OrderProcess};
use App\Http\Controllers\{AuthController, OrderController, HelpController};
use App\Http\Controllers\RestaurantController;

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

Route::post('/restaurants', [RestaurantController::class, 'create']);
Route::get('/restaurants', [RestaurantController::class, 'get']);
Route::get('/csrf-token', function() {
    return response()->json(['token' => csrf_token()]);
});



Route::get('/', OrderCart::class)->name('home');
Route::get('/help', [HelpController::class, 'index'])->name('help');

Route::group(['middleware' => 'auth'], function ()
{

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', Profile::class)->name('profile');

    Route::view('/verification/notice', 'user.verification')->name('verification.notice')->middleware('unverified');

    Route::group(['prefix' => 'order', 'as' => 'order.'], function ()
    {
        Route::get('/', OrderTable::class)->name('index');
        Route::get('/process', OrderProcess::class)->name('process');
        Route::get('/{invoice}/detail', [OrderController::class, 'detail'])->name('detail');
    });
});

Route::group(['middleware' => 'guest'], function ()
{

    Route::get('/login', Login::class)->name('login');
    Route::get('/login/{table}', LoginTable::class)->name('login.table');

});