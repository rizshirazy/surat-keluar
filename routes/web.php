<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('outbox', 'OutboxController')->names('outbox');
    Route::post('outbox/modal', 'OutboxController@modal')->name('outbox.modal');
    Route::post('outbox/report', 'OutboxController@report')->name('outbox.report');

    Route::resource('inbox', 'InboxController')->names('inbox');

    Route::resource('category', 'CategoryController')->names('category');
    Route::resource('user', 'UserController')->names('user');
});
