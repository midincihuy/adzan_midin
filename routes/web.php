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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('schedule', 'ScheduleController');
Route::resource('city', 'CityController');

Route::resource('generate', 'GenerateController');

Route::post('/255036040:AAE0dMDd4pzprAxXZQR28OANmbWwMRklbVk/webhook', 'WebhookController@index');
Route::resource('registration', 'RegistrationController');
Route::resource('update', 'UpdateController');

Route::get('/ajax/schedule', 'AjaxController@schedule')->name('ajax_schedule');
Route::get('/ajax/city', 'AjaxController@city')->name('ajax_city');
Route::get('/ajax/registration', 'AjaxController@registration')->name('ajax_registration');
Route::get('/ajax/update', 'AjaxController@update')->name('ajax_update');
