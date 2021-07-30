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

Route::get('/', 'Content\IndexController@index')->name('index');
Route::get('/peserta', 'Content\IndexController@peserta')->name('peserta');

Auth::routes([
    'register' => false
]);

Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'middleware' => 'auth'], function() {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/peserta', 'AdminController@peserta')->name('admin.peserta');
    Route::post('/peserta', 'AdminController@pesertaPost')->name('admin.peserta.post');
    Route::post('/peserta/update', 'AdminController@pesertaUpdate')->name('admin.peserta.update');
    Route::post('/peserta/delete', 'AdminController@pesertaDelete')->name('admin.peserta.delete');
    Route::get('/penilaian', 'AdminController@penilaian')->name('admin.penilaian');
    Route::post('/penilaian', 'AdminController@penilaianPost')->name('admin.penilaian.post');
    Route::post('/penilaian/update', 'AdminController@penilaianUpdate')->name('admin.penilaian.update');
    Route::post('/penilaian/delete', 'AdminController@penilaianDelete')->name('admin.penilaian.delete');

    Route::group(['prefix' => 'report'], function () {
        Route::get('/', function () { return redirect()->route('admin.peserta'); });
        Route::get('/peserta', function () { return redirect()->route('admin.peserta'); });
        Route::get('/penilaian', function () { return redirect()->route('admin.penilaian'); });
    });

    Route::post('/report/peserta', 'AdminController@reportPeserta')->name('admin.report.peserta');
    Route::post('/report/penilaian', 'AdminController@reportPenilaian')->name('admin.report.penilaian');
});
