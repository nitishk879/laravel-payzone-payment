<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['web'], 'namespace' => 'Svodya\Payzone\Http\Controllers'], function (){
    Route::get('payzone', 'PayzoneController@payment');
    Route::post('callback', 'PayzoneController@callback');
});

Route::group(['namespace' => 'Svodya\Payzone\Http\Controllers'], function (){
    Route::post('process', 'PayzoneController@process');
    Route::post('callback-server', 'PayzoneController@callbackServer');
    Route::get('debug', 'PayzoneController@debug');
    Route::get('logs', 'PayzoneController@log');
});
