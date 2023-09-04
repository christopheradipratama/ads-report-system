<?php

use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Report;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('create-report', 'ReportController@index_create')->name('create-report');
    Route::post('store-report', 'ReportController@store')->name('store-report');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::namespace('App\Http\Controllers')->group(function () {
        Route::get('report', 'ReportController@index')->name('report');
        
        Route::get('/verification-report/{id}', 'ReportController@verification')->name('verification-report');
        Route::post('/verify-report/{id}', 'ReportController@verify')->name('verify-report');
        Route::get('report-trackers', 'ReportController@index_report_trackers')->name('report-trackers');

        Route::get('report-log/{report}', 'ReportController@log')->name('report-log');
    });
});