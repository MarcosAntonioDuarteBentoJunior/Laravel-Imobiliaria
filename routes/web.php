<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RealtyController;
use App\Http\Controllers\RealtyPhotoController;
use App\Http\Controllers\UsageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [RealtyController::class, 'index']);
Route::get('/home', [RealtyController::class, 'index'])->name('home');
Route::get('/realty/category/{id}', [RealtyController::class, 'category'])->name('realty.category');
Route::get('/realty/usage/{id}', [RealtyController::class, 'usage'])->name('realty.usage');
Route::post('realty/search', [RealtyController::class, 'search'])->name('realty.search');
Route::post('/contact', [ContactController::class, 'send'])->name('message');

Auth::routes();
Route::resource('/realty', RealtyController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/category/dashboard', [CategoryController::class, 'index'])->name('category.dashboard');
    Route::get('/usage/dashboard', [UsageController::class, 'index'])->name('usage.dashboard');
    Route::post('/photo/remove', [RealtyPhotoController::class, 'removePhoto'])->name('photo.remove');
    Route::get('realty/appointment/{slug}', [RealtyController::class, 'appointment'])->name('appointment');

    Route::resource('/category', CategoryController::class);
    Route::resource('/usage', UsageController::class);
});

