<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::namespace('App\Http\Controllers')->group(function () {
//     Route::get('create-report', 'ReportController@index_create')->name('create-report');
//     Route::post('store-report', 'ReportController@store')->name('store-report');

//     Route::get('report', 'ReportController@index')->name('report');
    
//     Route::get('/verification-report/{id}', 'ReportController@verification')->name('verification-report');
//     Route::post('/verify-report/{id}', 'ReportController@verify')->name('verify-report');
//     Route::get('report-trackers', 'ReportController@index_report_trackers')->name('report-trackers');
//     // Route::get('reports-log', 'ReportController@log')->name('reports-log');
//     Route::get('reports/{report}/log', 'ReportController@log')->name('log');
// });