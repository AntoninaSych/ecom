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


Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});


Route::group(['middleware' => ['auth', 'is.block.user']], function () {
    Route::get('/home', 'HomeController@index')->name('home'); // default page for auth useres

    /**
     * Settings
     */
    Route::group(['prefix' => 'settings', 'middleware' => ['can.manage.roles']], function () {
        Route::get('/', 'SettingsController@index')->name('settings.index');
        Route::patch('/permissionsUpdate', 'SettingsController@permissionsUpdate');
        Route::patch('/overall', 'SettingsController@updateOverall');
        Route::match(['get'], '/users', 'UsersController@getList');
        Route::match(['get'], '/applyRole', 'UsersController@applyRole');
        Route::match(['get'], '/statusUpdate', 'UsersController@statusUpdate');


    });
    Route::group(['prefix' => 'payments', 'middleware' => ['can.view.payments']], function () {
        Route::get('/', 'PaymentsController@index')->name('payments');
        Route::match(['get'], '/datatable', 'PaymentsController@anyData')->name('get.search.payment');
        Route::match(['get'], '/view', 'PaymentsController@getOneById');
        Route::match(['get'], '/getProcessLog', 'PaymentsController@getProcessLog');
    });

    Route::group(['prefix' => 'merchants'], function () {
        Route::match(['get'], '/getlistByName', 'MerchantController@getlistByName'); // роут используется в поиске платежей

        Route::group(['middleware' => 'can.view.merchants'], function () {
            Route::match(['get'], '/', 'MerchantController@list');
            Route::match(['get'], '/datatable', 'MerchantController@anyData')->name('get.search.merchants');
            Route::match(['get'], '/{id}', 'MerchantController@getOneById')->name('merchant.detail');
            Route::match(['post'], '/{id}', 'MerchantController@update')->name('merchant.update');

        });
    });

    Route::resource('mcc', 'MccController')->only([
        'index', 'store', 'edit', 'update','create'
    ])->middleware('can.manage.mcc');


    Route::match(['get'], '/mcc/datatable', 'MccController@anyData')->name('get.search.mcc.codes')->middleware('can.manage.mcc');
    Route::match(['get'], '/mcc/destroy/{id}', 'MccController@destroy')->middleware('can.manage.mcc');
});
