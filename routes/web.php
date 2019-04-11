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

/**
 * Settings
 */
Route::group(['prefix' => 'settings','middleware' =>[ 'can.manage.roles']], function () {
    Route::get('/', 'SettingsController@index')->name('settings.index');
    Route::patch('/permissionsUpdate', 'SettingsController@permissionsUpdate');
    Route::patch('/overall', 'SettingsController@updateOverall');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); // don't delete - for users who not in login


//Route::match(['get'], 'getRequests', 'Api\RequestHandler@getRequests');

Route::group(['prefix' => 'merchants'], function () {
    Route::match(['get'], '/getlistByName', 'MerchantController@getlistByName');
});

Route::group(['prefix' => 'payments'], function () {
    Route::get('/', 'PaymentsController@payments')->name('payments');
    Route::match(['get'], '/getSearchResponse', 'PaymentsController@getSearchResponse');
});