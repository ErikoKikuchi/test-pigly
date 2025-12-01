<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogsController;

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

Route::get('/register/step1', function () {return view('auth.register_step1');});
Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [WeightLogsController::class,'index']);
});
Route::post('/register/step1', [WeightLogsController::class,'create']);
Route::get('/register/step2', function () {return view('auth.register_step2');});
Route::post('/register/step2', [WeightLogsController::class,'store']);
Route::post('login', [WeightLogsController::class,'login']);