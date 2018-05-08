<?php

Route::group(['middleware' => 'web', 'prefix' => 'presentations2go', 'namespace' => 'Modules\Presentations2Go\Http\Controllers'], function()
{
    Route::get('/', 'Presentations2GoController@index');
});
