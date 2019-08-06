<?php

use Illuminate\Http\Request;

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

Route::group(['namespace' => 'Api'], function () {


    Route::group(['namespace' => 'Auth'], function () {
        Route::post('register', 'RegisterController');
        Route::post('login', 'LoginController')->name('login');
        Route::post('logout', 'LogoutController')->middleware('auth:api');
    });


    Route::get('user/details', 'UserController@details')->middleware('auth:api');


    Route::group(['middleware' => 'auth:api', 'prefix'=>'note'], function () {
        //я бы делал методы для добавления POST. Для обновления данный по той же ссылки но PUTCH\PUT. В тех. задании немного иначе описана задача
        //Route::resource('note', 'NoteController');
        Route::post('create', 'NoteController@store');
        Route::post('update', 'NoteController@update');
        Route::get('list', 'NoteController@index');
    });





});
