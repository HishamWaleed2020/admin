<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

// Route::group(['prefix' => LaravelLocalization::setLocale()], function()
//     {
Route::prefix(LaravelLocalization::setLocale())->group(function () {

    Route::prefix('admin')->name('admin.')->middleware('auth', 'check', 'verified')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('roles', RoleController::class);
    });


    Route::get('/', function () {
        return view('welcome');
    })->name('site.home');

    // Auth::routes(['register' => false]);
    Auth::routes(['verify' => true]);
    // Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
