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
    return redirect('/login');
});

Auth::routes();



Auth::routes();

Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home'); // don't delete - for users who not in login

    /**
     * Settings
     */
    Route::group(['prefix' => 'settings','middleware' =>[ 'can.manage.roles']], function () {
        Route::get('/', 'SettingsController@index')->name('settings.index');
        Route::patch('/permissionsUpdate', 'SettingsController@permissionsUpdate');
        Route::patch('/overall', 'SettingsController@updateOverall');
        Route::match(['get'], '/users', 'UsersController@getList');
    });

//Route::match(['get'], 'getRequests', 'Api\RequestHandler@getRequests');

    Route::group(['prefix' => 'merchants'], function () {
        Route::match(['get'], '/getlistByName', 'MerchantController@getlistByName');
    });

    Route::group(['prefix' => 'payments'], function () {
        Route::get('/', 'PaymentsController@payments')->name('payments');
        Route::match(['get'], '/getSearchResponse', 'PaymentsController@getSearchResponse');
        Route::match(['get'], '/view', 'PaymentsController@getOneById');
    });
});
