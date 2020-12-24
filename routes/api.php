<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'namespace' => "App\Http\Controllers"
], function ($router) {

    Route::group(['prefix' => 'customers'], function () {
        Route::post('create', 'CustomerController@createCustomer');
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('{customer_id}', 'OrderController@getOrders');
        Route::post('create/{customer_id}', 'OrderController@createOrder');
    });
});
