<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'RegistrationController@index');
Route::get('/registration_success', 'RegistrationController@success');
Route::resource('registration', 'RegistrationController');

Route::get('/account/extend/{userUuid}', 'AccountActionsController@extend');
Route::get('/account/delete/{userUuid}', 'AccountActionsController@delete');

Route::get('/admin', 'DashboardController@index');
Route::get('/admin/users', 'AdminUsersController@index');
Route::get('/admin/users/view/{userUuid}', 'AdminUsersController@view');
