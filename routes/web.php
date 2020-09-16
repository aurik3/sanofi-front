<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SFTestController;

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

Route::get('/home', function () {
    return view('home');
}) -> name('home');

Route::get('/login', function () {
    return view('login');
});
