<?php

use App\Category;
use App\Outbox;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    Route::get('inbox/{inbox}/print', 'InboxController@print')->name('inbox.print');
    Route::post('inbox/modal', 'InboxController@modal')->name('inbox.modal');
    Route::post('inbox/report', 'InboxController@report')->name('inbox.report');

    Route::prefix('disposition')->group(function () {
        Route::post('create', 'DispositionController@store')->name('disposition.store');
        Route::get('{id}/edit', 'DispositionController@edit')->name('disposition.edit');
        Route::put('{id}/update', 'DispositionController@update')->name('disposition.update');
        Route::put('{id}/complete', 'DispositionController@complete')->name('disposition.complete');
    });

    Route::resource('category', 'CategoryController')->names('category');
    Route::resource('user', 'UserController')->names('user');

    Route::get('disposition/populate', 'DispositionController@populateByUser')->name('disposition.populate_by_user');
    Route::view('change-password', 'auth.passwords.change')->name('password.change.view');
    Route::post('change-password', 'UserController@change_password')->name('password.change.post');

    // Route::middleware(['CheckRole:admin'])->group(function () {
    //     Route::get('clear', function () {
    //         Artisan::call('cache:clear');
    //         Artisan::call('config:clear');
    //         Artisan::call('config:cache');
    //         Artisan::call('view:clear');

    //         return 'Cleared';
    //     })->name('clear');

    //     Route::get('link', function () {
    //         Artisan::call('storage:link');

    //         return 'Linked';
    //     })->name('link');
    // });
});
