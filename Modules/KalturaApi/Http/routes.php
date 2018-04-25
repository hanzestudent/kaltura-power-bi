<?php

Route::group(['middleware' => 'web', 'prefix' => 'kalturaapi', 'namespace' => 'Modules\KalturaApi\Http\Controllers'], function()
{
    Route::get('/', 'KalturaApiController@index');
});
