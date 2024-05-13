<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\{Profile, Setting, Help};
use App\Http\Livewire\Admin\Auth\Login;
use App\Http\Livewire\Admin\Category\Table as CategoryTable;
use App\Http\Livewire\Admin\Menu\{Table as MenuTable, Create as CreateMenu, Edit as EditMenu};
use App\Http\Livewire\Admin\Table\Table as TableTable;
use App\Http\Livewire\Admin\User\Table as UserTable;
use App\Http\Livewire\Admin\Admin\Table as AdminTable;
use App\Http\Livewire\Admin\Order\{Cart as NewOrder, Process as ProcessOrder, Table as OrderTable};
use App\Http\Controllers\Admin\{AuthController, DashboardController, OrderController, ReportController};

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
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/setting', Setting::class)->name('setting');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/help', Help::class)->name('help');

    Route::get('/categories', CategoryTable::class)->name('categories')->middleware('can:admin');
    Route::get('/tables', TableTable::class)->name('tables');
    Route::get('/users', UserTable::class)->name('users')->middleware('can:admin');
    Route::get('/admins', AdminTable::class)->name('admins')->middleware('can:admin');

    Route::group(['prefix' => 'menus', 'as' => 'menus.', 'middleware' => 'canany:admin,pelayanan'], function ()
    {   
        Route::get('/', MenuTable::class)->name('index');
        Route::get('/create', CreateMenu::class)->name('create');
        Route::get('/{menu}/edit', EditMenu::class)->name('edit');
    });

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function ()
    {
        Route::get('/', OrderTable::class)->name('index');
        Route::get('/create', NewOrder::class)->name('create');
        Route::get('/process', ProcessOrder::class)->name('process');
        Route::get('/{invoice}/detail', [OrderController::class, 'detail'])->name('detail');
        Route::get('/{invoice}/print', [OrderController::class, 'print'])->name('print');
        Route::get('/{invoice}/print-per-type', [OrderController::class, 'printPerType'])->name('print-per-type');
        Route::get('/{invoice}/print-update', [OrderController::class, 'printUpdate'])->name('print-update');
    });

    Route::group(['prefix' => 'reports', 'as' => 'reports.', 'middleware' => 'canany:admin,kasir'], function ()
    {
        Route::view('/date', 'admin.report.date')->name('date'); 
        Route::view('/month', 'admin.report.month')->name('month'); 
        Route::view('/period', 'admin.report.period')->name('period'); 

        Route::group(['prefix' => 'print', 'as' => 'print.'], function ()
        {
            Route::get('/date', [ReportController::class, 'date'])->name('date'); 
            Route::get('/month', [ReportController::class, 'month'])->name('month'); 
            Route::get('/period', [ReportController::class, 'period'])->name('period'); 
            Route::get('/all', [ReportController::class, 'all'])->name('all');
        });
    });
});

Route::group(['middleware' => 'guest:admin'], function ()
{
    Route::get('/login', Login::class)->name('login');
});