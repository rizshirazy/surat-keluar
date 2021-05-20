<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('category/populate', 'CategoryController@populate')->name('api.category.populate');
Route::post('category/detail', 'CategoryController@detail')->name('api.category.detail');
Route::post('group-category/populate', 'GroupCategoryController@populate')->name('api.group_category.populate');
Route::post('department/populate', 'DepartmentController@populate')->name('api.department.populate');
