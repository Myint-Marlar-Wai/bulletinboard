<?php

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

/* Users */
Route::group(['middleware' => 'auth'], function() {
    Route::resource('user', UserController::class);
    Route::post('user/confirm', 'UserController@confirm')->name('user.confirm');
    Route::post('user/{user}/update_confirm', 'UserController@updateConfirm')->name('user.updateConfirm');
    Route::post('user/{id}/update_store', 'UserController@update')->name('user.update');
    Route::post('user/{user}/profile', 'UserController@userProfile')->name('user.userProfile');
    Route::get('user/{id}/change_password', 'UserController@passwordScreen')->name('user.passwordScreen');
    Route::post('user/id}/change_password', 'UserController@changePassword')->name('user.changePassword');
    Route::get('search', 'UserController@search');
});

/* Post */
Route::group(['middleware' => 'auth'], function() {
    Route::resource('post', PostController::class);
    Route::post('', 'PostController@exportIntoExcel')->name('post.exportIntoExcel');
    Route::post('post/confirm', 'PostController@postConfirm')->name('post.postConfirm');
    Route::post('post/update_confirm', 'PostController@updateConfirm')->name('post.updateConfirm');
    Route::get('search', 'PostController@search');
    Route::get('post/import_form', 'PostController@importForm')->name('post.importForm');
    Route::post('post/import_form', 'PostController@import')->name('post.import');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
