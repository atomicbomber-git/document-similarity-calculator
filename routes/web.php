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

use App\Http\Controllers\ThesisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/process/control_panel');

Route::group(['prefix' => '/process', 'as' => 'process.'], function () {
    Route::view('/control_panel', 'process.control_panel')->name('control_panel')->middleware("auth");
    Route::post('/stem', 'ProcessController@stem')->name('stem');
    Route::get('/clean', 'ProcessController@clean')->name('clean');
    Route::get('/term_freq', 'ProcessController@termFrequency')->name('term_freq');
});

Route::group(['prefix' => '/thesis', 'as' => 'thesis.'], function () {
    Route::get('/index', [ThesisController::class, 'index'])->name('index');
    Route::get('/create', [ThesisController::class, 'create'])->name('create');
    Route::get('/detail/{thesis}', [ThesisController::class, 'detail'])->name('detail');
    Route::post('/update/{thesis}', [ThesisController::class, 'update'])->name('update');
    Route::post('/store', [ThesisController::class, 'store'])->name('store');
    Route::get('/compare/{thesis}', [ThesisController::class, 'compare'])->name('compare');
    Route::get('/summary/{thesis}', [ThesisController::class, 'summary'])->name('summary');
    Route::post('/delete/{thesis}', [ThesisController::class, 'delete'])->name('delete');
});

Auth::routes();