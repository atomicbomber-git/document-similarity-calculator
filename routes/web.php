<?php
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

Route::redirect('/', '/process/control_panel');

Route::group(['prefix' => '/process', 'as' => 'process.'], function() {
    Route::view('/control_panel', 'process.control_panel')->name('control_panel');
    Route::post('/stem', 'ProcessController@stem')->name('stem');
    Route::get('/clean', 'ProcessController@clean')->name('clean');
    Route::get('/freq_dist', 'ProcessController@frequencyDistribution', 'freq_dist');
    Route::get('/term_freq', 'ProcessController@termFrequency', 'term_freq');
});