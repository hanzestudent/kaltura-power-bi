<?php

Route::group(['middleware' => 'web', 'prefix' => 'datawarehouse', 'namespace' => 'Modules\Datawarehouse\Http\Controllers'], function()
{
    Route::get('/', 'DatawarehouseController@index');
});
