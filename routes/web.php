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

Route::group(['prefix' => '/thesis', 'as' => 'thesis.'], function() {
    Route::get('/index', 'ThesisController@index')->name('index');
    Route::get('/create', 'ThesisController@create')->name('create');
    Route::get('/detail/{thesis}', 'ThesisController@detail')->name('detail');
    Route::post('/update/{thesis}', 'ThesisController@update')->name('update');
    Route::post('/store', 'ThesisController@store')->name('store');
    Route::post('/delete/{thesis}', 'ThesisController@delete')->name('delete');
});