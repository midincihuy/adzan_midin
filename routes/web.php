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
    $res = Telegram::setWebhook([
        'url' => 'https://salty-escarpment-49242/<token>/webhook'
    ]);
    dd($res);

});

Route::post('<token>/webhook', function () {

    /** @var \Telegram\Bot\Objects\Update $update */
    $update = Telegram::commandsHandler(true);

    return 'ok';
});
