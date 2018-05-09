<?php

Route::group(['middleware' => 'web', 'prefix' => 'digirooster', 'namespace' => 'Modules\Digirooster\Http\Controllers'], function()
{
    Route::get('/', 'DigiroosterController@index');
});
