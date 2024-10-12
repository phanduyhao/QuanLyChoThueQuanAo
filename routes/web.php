<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChothueController;
use App\Http\Controllers\DoanhthuController;
use App\Http\Controllers\KhoController;
use App\Http\Controllers\ProductController;

Route::get( '/', [LoginController::class, 'showLoginForm'])->name(name: 'showLoginForm');
Route::post('/login',[LoginController::class,'login'])->name('login');

// Đăng xuất
Route::post('/logout',[LoginController::class,'logout'])->name('logout');


Route::middleware('auth')->group(function () {

    // Home 
    Route::get('/home', [HomeController::class, 'home'])->name('home');

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);

    Route::resource('customers', CustomerController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    Route::resource('khos', KhoController::class);

    Route::resource('chothues', ChothueController::class);
    Route::delete('/chothue_product/delete/{id}', [ChothueController::class, 'destroyProduct']);

    Route::resource('doanhthus', DoanhthuController::class);

    Route::resource('settings', SettingController::class);
    Route::post('settings/update', [SettingController::class, 'update'])->name('update');

    
});