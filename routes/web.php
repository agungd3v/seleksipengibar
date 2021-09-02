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

    Route::get('/materi', 'AdminController@materi')->name('admin.materi');
    Route::post('/materi', 'AdminController@materiPost')->name('admin.materi.post');
    Route::post('/materi/update', 'AdminController@materiUpdate')->name('admin.materi.update');
    Route::post('/materi/delete', 'AdminController@materiDelete')->name('admin.materi.delete');
    
    Route::get('/ruang', 'AdminController@ruang')->name('admin.ruang');
    Route::post('/ruang', 'AdminController@ruangPost')->name('admin.ruang.post');
    Route::post('/ruang/update', 'AdminController@ruangUpdate')->name('admin.ruang.update');
    Route::post('/ruang/delete', 'AdminController@ruangDelete')->name('admin.ruang.delete');
    
    Route::get('/penilai', 'AdminController@penilai')->name('admin.penilai');
    Route::post('/penilai', 'AdminController@penilaiPost')->name('admin.penilai.post');
    Route::post('/penilai/update', 'AdminController@penilaiUpdate')->name('admin.penilai.update');
    Route::post('/penilai/delete', 'AdminController@penilaiDelete')->name('admin.penilai.delete');

    Route::get('/penilaian', 'AdminController@penilaian')->name('admin.penilaian');
    Route::post('/penilaian', 'AdminController@penilaianPost')->name('admin.penilaian.post');

    Route::get('/rekap', 'AdminController@rekap')->name('admin.rekap');

    Route::group(['prefix' => 'report'], function () {
        Route::get('/', function () { return redirect()->route('admin.peserta'); });
        Route::get('/peserta', function () { return redirect()->route('admin.peserta'); });
        Route::get('/rekap', function () { return redirect()->route('admin.rekap'); });
    });

    Route::post('/report/peserta', 'AdminController@reportPeserta')->name('admin.report.peserta');
    Route::get('/report/peserta/{id}', 'AdminController@reportPesertaId')->name('admin.report.peserta.id');
    Route::post('/report/rekap', 'AdminController@reportRekap')->name('admin.report.rekap');

    Route::post('/changepassword', 'AdminController@changePassword')->name('admin.changepwd');
});
