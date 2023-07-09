<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\PelayananController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function() {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
});

// Admin
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Route Hotel
    Route::resource('hotel', HotelController::class);
    
    // Route Fasilitas
    Route::resource('fasilitas', FasilitasController::class);
    
    // RoutePelayanan
    Route::resource('pelayanan', PelayananController::class);

    // Setting
    Route::get('setting', [SettingController::class, 'index'])->name('setting');
    Route::post('setting/edit', [SettingController::class, 'store'])->name('setting.edit');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
