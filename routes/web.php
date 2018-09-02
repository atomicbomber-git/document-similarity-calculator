<?php
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
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
    // $out = '';
    // $status = '';
    // $test = exec("python ../scripts/remove_conjunctions.py \"test test test\"", $out, $status);
    // $test = exec("python");
    $python_exe = "C:\Users\James Patrick Keegan\AppData\Local\Programs\Python\Python37-32\python.exe";
    
    $process = new Process([
        $python_exe,
        '../scripts/remove_conjunctions.py',
        '"test test test"']
    );
    $process->run();

    $test = [];
    foreach ($process as $type => $data) {
        $test[] = $data;
    }
    // if (!$process->isSuccessful()) {
    //     return "fail";
    // }

    return $test;

    return $process->getOutput();
});