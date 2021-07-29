<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false
]);

Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard'], function() {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/peserta', 'AdminController@peserta')->name('admin.peserta');
    Route::post('/peserta', 'AdminController@pesertaPost')->name('admin.peserta.post');
});

// Route::get('/home', 'HomeController@index')->name('home');
