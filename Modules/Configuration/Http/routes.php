<?php

Route::group([
    'prefix' => 'admin/configurations',
    'namespace' => 'Modules\Configuration\Http\Controllers\Admin',
    'middleware' => ['web','auth', 'roles'], 'roles' => 'admin'
], function()
{
    Route::get('/', 'ConfigurationsController@index');
    Route::get('/create', 'ConfigurationsController@create');
    Route::get('/{id}', 'ConfigurationsController@show');
    Route::get('/{id}/edit', 'ConfigurationsController@edit');
    Route::patch('/{id}', 'ConfigurationsController@update');
    Route::post('/','ConfigurationsController@store');
    Route::delete('/{id}','ConfigurationsController@destroy');
});
