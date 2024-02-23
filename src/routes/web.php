<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Sky\LicEcommerce\Http\Controllers'], function(){

    Route::get('installlic','LicEcommerceController@index');
    Route::post('installlic','LicEcommerceController@store')->name('installlic');
    Route::get('lic-expired','LicEcommerceController@expired');


});