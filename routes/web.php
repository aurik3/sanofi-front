<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SFTestController;
use App\Http\Controllers\SFSessionController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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

Route::get('/test/elements', [SFTestController::class, 'lookup_frontend_modules']);
Route::get('/test/elements/{module}', [SFTestController::class, 'lookup_specific_module']);

Route::get('/', function () {
   return view('landing');
}) -> name('landing');

Route::get('/verif-notice', function () {
    return redirect(\route('landing'));
}) -> name('verification.notice');

Route::get('/home', function () {
    return view('home');
}) -> name('home') -> middleware('auth');

Route::post('/m-logout', [SFSessionController::class, 'logout'])
    ->name('m-logout');

Route::get('/test/microlearning', function () {
    return view('microlearning.test');
}) -> middleware('auth');

Route::post('/test/microlearning', [SFTestController::class, 'build_component_map']) -> name('microtest');
