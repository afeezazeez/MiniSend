<?php

use App\Http\Controllers\EmailController;
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


Route::group(['prefix'=>'v1', 'middleware' => 'throttle:60'], function(){

    Route::get('/emails/analytics','App\Http\Controllers\Api\EmailController@analytics');
    Route::get('/emails/search','App\Http\Controllers\Api\EmailController@searchEmails');
    Route::get('/emails/recipient/{email}','App\Http\Controllers\Api\EmailController@fetchRecipientEmails');
    Route::get('/emails/recipient/search/{email}','App\Http\Controllers\Api\EmailController@searchRecipientEmails');
    Route::apiResource('/emails','App\Http\Controllers\Api\EmailController');

});
