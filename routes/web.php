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

Route::middleware(['auth'])->prefix('message')->group(function () {

    Route::get('/compose', 'MessageController@compose')->name('composeMessage');
    Route::post('/send', 'MessageController@send')->name('sendMessage');
    Route::post('/reply', 'MessageController@reply')->name('replyMessage');
    Route::get('/messages', 'MessageController@listMessages')->name('listMessage');
    Route::get('/view', 'MessageController@viewMessage')->name('viewMessage');

});