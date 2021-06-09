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
    Route::get('inbox/{id}/print', 'InboxController@print')->name('inbox.print');

    // Route::resource('disposition', 'DispositionController')->names('disposition');
    Route::prefix('disposition')->group(function () {
        Route::post('create', 'DispositionController@store')->name('disposition.store');
        Route::get('{id}/edit', 'DispositionController@edit')->name('disposition.edit');
        Route::put('{id}/update', 'DispositionController@update')->name('disposition.update');
        Route::put('{id}/complete', 'DispositionController@complete')->name('disposition.complete');
    });

    Route::resource('category', 'CategoryController')->names('category');
    Route::resource('user', 'UserController')->names('user');

    Route::get('disposition/populate', 'DispositionController@populateByUser')->name('disposition.populate_by_user');
});
