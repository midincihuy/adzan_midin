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

Route::get('/set', function () {
    $res = \Telegram::setWebhook([
        'url' => 'https://salty-escarpment-49242.herokuapp.com/255036040:AAE0dMDd4pzprAxXZQR28OANmbWwMRklbVk/webhook'
    ]);
    dd($res);

});

Route::post('/255036040:AAE0dMDd4pzprAxXZQR28OANmbWwMRklbVk/webhook', function () {

    /** @var \Telegram\Bot\Objects\Update $update */
    $update = \Telegram::commandsHandler(true);

    return 'ok';
});
Route::resource('registration', 'RegistrationController');

Route::get('/ajax/schedule', 'AjaxController@schedule')->name('ajax_schedule');
Route::get('/ajax/city', 'AjaxController@city')->name('ajax_city');
Route::get('/ajax/registration', 'AjaxController@registration')->name('ajax_registration');
