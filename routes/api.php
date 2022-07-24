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

Route::group(['prefix'=>'users'],function(){
    Route::post('login',[\App\Http\Controllers\Api\AuthController::class,'login']);
    Route::post('register','AuthController@register');

    Route::group(['middleware'=>'check_token'],function(){
        Route::get('profile/{profile}','AuthController@profile');

    });

});
