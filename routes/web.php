<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FrequencyController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(App\Http\Controllers\Auth\AuthOtpController::class)->group(function(){
    Route::get('otp/login', 'login')->name('otp.login');
    Route::post('otp/generate', 'generate')->name('otp.generate');
    Route::get('otp/verification/{user_id}', 'verification')->name('otp.verification');
    Route::post('otp/login', 'loginWithOtp')->name('otp.getlogin');
});


Route::group(['middleware' => ['auth']], function () {
	Route::resource('frequencies', FrequencyController::class);
	Route::resource('services', ServiceController::class);
});