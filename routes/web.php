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

Route::view('/main/control_panel', 'main.control_panel');

Route::view('/process/control_panel', 'process.control_panel');

Route::post('/process/stem', 'ProcessController@stem')->name('process.stem');
Route::get('/process/test', function() {
    $test = exec('pwd ..');
    return $test;
});