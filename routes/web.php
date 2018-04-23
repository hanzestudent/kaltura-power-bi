<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('dashboard');
});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin/users', 'middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
    Route::get('/', 'UsersController@index')->name('Users');
    Route::get('/create', 'UsersController@create')->name('Create user');
    Route::get('/{id}', 'UsersController@show')->name('View user');
    Route::get('/{id}/edit',  'UsersController@edit')->name('Edit user');
    Route::post('/', 'UsersController@store')->name('Save New User');
    Route::delete('/{id}','UsersController@destroy')->name('Delete User');
    Route::patch('/{id}','UsersController@update')->name('Update User');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin/roles', 'middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
    Route::get('/', 'RolesController@index')->name('Roles');
    Route::get('/create', 'RolesController@create')->name('Create Role');
    Route::get('/{id}', 'RolesController@show')->name('View Role');
    Route::get('/{id}/edit',  'RolesController@edit')->name('Edit Role');
    Route::post('/', 'RolesController@store')->name('Save New Role');
    Route::delete('/{id}','RolesController@destroy')->name('Delete Role');
    Route::patch('/{id}','RolesController@update')->name('Update Role');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin/permissions', 'middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
    Route::get('/', 'PermissionsController@index')->name('Permissions');
    Route::get('/create', 'PermissionsController@create')->name('Create Permission');
    Route::get('/{id}', 'PermissionsController@show')->name('View Permission');
    Route::get('/{id}/edit',  'PermissionsController@edit')->name('Edit Permission');
    Route::post('/', 'PermissionsController@store')->name('Save New Permission');
    Route::delete('/{id}','PermissionsController@destroy')->name('Delete Permission');
    Route::patch('/{id}','PermissionsController@update')->name('Update Permission');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
    Route::get('/generator', '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator');
    Route::post('/generator','\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator');
});


Auth::routes();