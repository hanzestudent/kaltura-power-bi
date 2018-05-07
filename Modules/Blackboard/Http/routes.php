<?php

Route::group(['middleware' => 'web', 'prefix' => 'blackboard', 'namespace' => 'Modules\Blackboard\Http\Controllers'], function()
{
    Route::get('/', 'BlackboardController@index');
});
