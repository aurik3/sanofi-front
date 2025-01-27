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

// -------- TEST ROUTES, COMMENT OUT IN PRODUCTION ----------------------------------------------------------

Route::get('/test/elements', [SFTestController::class, 'lookup_frontend_modules']);
Route::get('/test/elements/{module}', [SFTestController::class, 'lookup_specific_module']);
Route::get('/test/events', [SFTestController::class, 'view_events']) -> middleware('auth');
Route::get('/test/evstats', [SFTestController::class, 'view_stats']) -> middleware('auth');
Route::get('/test/users', [SFTestController::class, 'view_users']);
Route::post('/test/microlearning', [SFTestController::class, 'build_component_map']) -> name('microtest');
Route::get('/test/microlearning', function () {
    return view('microlearning.test');
}) -> middleware('auth');

// --------------- PRODUCTION ROUTES, DO NOT COMMENT -------------------------------------------------------

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

Route::get('/vital', function () {
    return view('programs.vital');
}) -> name('prog.vital');

Route::get('/amigos', function () {
    return view('programs.amigos');
}) -> name('prog.amigos');
