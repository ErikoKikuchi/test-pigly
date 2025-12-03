<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogsController;
use App\Http\Controllers\RegisterController;
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

Route::middleware('guest')->group(function () {
    Route::get('/register/step1', function () {
        return view('auth.register_step1');});
    Route::post('/register/step1', [RegisterController::class, 'create']);
    Route::get('/register/step2', function () {
        return view('auth.register_step2');});
    Route::post('/register/step2', [RegisterController::class, 'store']);
    Route::get('/login', function () {return view('auth.login');})->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [WeightLogsController::class,'index']);
    Route::post('/logout', function () {auth()->logout();
        return redirect('/login');});
    Route::get('/weight_logs/goal_setting', [WeightLogsController::class, 'show'])->name('goal_setting');
    Route::post('weight_logs/goal_setting', [WeightLogsController::class, 'save']);
    Route::get('/weight_logs/search', [WeightLogsController::class, 'search']);
    Route::get('/weight_logs/create', [WeightLogsController::class, 'create']);
    Route::post('/weight_logs/create', [WeightLogsController::class, 'store']);
    Route::get('/weight_logs/{weightLogId}',[WeightLogsController::class, 'edit'])->name('weight_logs.edit');
    Route::patch('/weight_logs/{weightLogId}/update',[WeightLogsController::class, 'update'])->name('weight_logs.update');
    Route::delete('/weight_logs/{weightLogId}/delete',[WeightLogsController::class, 'destroy'])->name('weight_logs.delete');
    });

Route::get('/session-check', function () {
    auth()->attempt(['email' => 'test@example.com', 'password' => 'password']);
    return [
        'auth' => Auth::check(),
        'session' => session()->all()
    ];
});
