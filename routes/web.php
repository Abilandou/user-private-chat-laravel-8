<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/userlist', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/usermessage/{id}', [App\Http\Controllers\UserController::class, 'getMessages'])->name('user.messages');
Route::post('/sendmessage', [App\Http\Controllers\UserController::class, 'sendMessage'])->name('user.send.message');