<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function(){
    Route::group(['middleware' => 'role:User'], function(){
        Route::get('/feedback', [App\Http\Controllers\UserController::class, 'index'])->name('user');
        Route::post('/feedback', [App\Http\Controllers\UserController::class, 'store'])->name('application.store')->middleware('throttle:create_application');
    });

    Route::group(['middleware' => 'role:Manager'], function(){
        Route::get('/dashboard', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager');
    });


    
});

