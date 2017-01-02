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

Route::get('/errormessage', function()
{
    return View::make('errors/custom');
});

Route::get('/account/resend/{userUuid}', 'AccountActionsController@resend');
Route::get('/account/extend/{userUuid}', 'AccountActionsController@extend');
Route::get('/account/reactivate/{userUuid}', 'AccountActionsController@reactivate')->middleware('auth');
Route::get('/account/delete/{userUuid}', 'AccountActionsController@delete');

Route::get('/admin', 'DashboardController@index')->middleware('auth');
Route::get('/admin/users', 'AdminUsersController@index')->middleware('auth');
Route::get('/admin/users/listdeactivated', 'AdminUsersController@listdeactivated')->middleware('auth');
Route::get('/admin/users/view/{userUuid}', 'AdminUsersController@view')->middleware('auth');

Auth::routes();
