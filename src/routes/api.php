<?php

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

// Route::resource('/product', 'Ecommerce\ApiProductController');
Route::group(['prefix' => 'v1'], function () {

    Route::group(['namespace'=>'User'],function (){
        Route::post('/register', 'ApiUserController@register');
        Route::post('/login', 'ApiUserController@login');
    });

    Route::group(['middleware' => ['admin']], function () {
        Route::group(['namespace'=>'Ecommerce'],function (){
            Route::post('/product', 'ApiProductController@store');
            Route::delete('product/{id}', 'ApiProductController@destroy');
            Route::patch('product/{id}', 'ApiProductController@update');
        });
    });

    Route::group(['middleware' => ['user']], function () {
        Route::get('/user', 'User\ApiUserController@userInfo');
        Route::group(['namespace'=>'Ecommerce'],function (){
            Route::get('/product', 'ApiProductController@index');
            Route::get('product/{slug}', 'ApiProductController@show');
        });
    });

});