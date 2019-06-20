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

Route::group(['middleware' => ['log.request']], function () {
    Route::group(['middleware' => ['auth', 'is.block.user']], function () {
        Route::get('/home', 'HomeController@index')->name('home'); // default page for auth useres

        Route::get('/', function () {
            return redirect('/login');
        });
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
                Route::match(['get'], '/{merchantId}/account/table', 'MerchantAccountController@getList');
                Route::match(['get'], '/', 'MerchantController@list');
                Route::match(['get'], '/datatable', 'MerchantController@anyData')->name('get.search.merchants');
                Route::match(['get'], '/{merchantId}', 'MerchantController@getOneById')->name('merchant.detail');
                Route::match(['post'], '/{merchantId}', 'MerchantController@update')->name('merchant.update');
                Route::match(['get'], '/{merchantId}/account', 'MerchantAccountController@getList');
                Route::match(['post'], '/account/add', 'MerchantAccountController@store')->name('account.store');
                Route::match(['get'], '/account/update', 'MerchantAccountController@update')->name('account.update');
                Route::match(['post'], '/account/destroy', 'MerchantAccountController@destroy')->name('account.destroy');

                Route::group(['prefix' => 'payment-type', 'middleware' => 'can.manage.merchant.payment.type'], function () {
                    Route::match(['get'], '/{merchantId}/table', 'MerchantPaymentTypeController@getTable');
                    Route::match(['post'], '/store', 'MerchantPaymentTypeController@store')->name('payment-type.store');
                    Route::match(['get'], '/update', 'MerchantPaymentTypeController@update')->name('payment-type.update');
                });

                Route::group(['prefix' => '/route', 'middleware' => 'can.manage.merchant.route'], function () {
                    Route::match(['get'], '/table', 'MerchantRoutesController@getTable');
                    Route::match(['post'], '/store', 'MerchantRoutesController@store')->name('payment-route.store');
                    Route::match(['post'], '/update', 'MerchantRoutesController@update')->name('payment-route.update');
                    Route::match(['get'], '/getAllowedRoutes/{paymentTypeId}', 'MerchantRoutesController@getAllowedRoutes');
                });

                Route::group(['prefix' => '/limits', 'middleware' => 'can.manage.merchant.route'], function () {
                    Route::match(['get'], '/table', 'MerchantLimitsController@getTable');
                    Route::match(['post'], '/store', 'MerchantLimitsController@store')->name('payment-limit.store');
                    Route::match(['post'], '/update', 'MerchantLimitsController@update')->name('payment-limit.update');
                });
            });
        });

        Route::group(['prefix' => 'queries', 'middleware' => ['can.apply.merchants.request']], function () {
            Route::match(['get'], '/search-queries', 'MerchantInfoController@anyData')->name('get.search.merchant.queries');
            Route::match(['get'], '/archive-queries', 'MerchantInfoController@archive');
            Route::match(['get'], '/archive', 'MerchantInfoController@archiveData')->name('get.search.merchant.queries.archive');
            Route::match(['get'], '/apply', 'MerchantInfoController@apply');
            Route::match(['get'], '/', 'MerchantInfoController@index');
            Route::match(['get'], '/{id}', 'MerchantInfoController@show');
            Route::match(['post'], '/assign', 'MerchantInfoController@assign');
        });

        Route::group(['prefix' => 'statistic', 'middleware' => ['can.view.statistics']], function () {
            Route::match(['get'], '/', 'StatisticController@all');
            Route::match(['get'], '/merchant/{id}', 'StatisticController@merchant');

        });


        Route::resource('mcc', 'MccController')->only([
            'index', 'store', 'edit', 'update', 'create'
        ])->middleware('can.manage.mcc');

        Route::match(['get'], '/mcc/{id_code}/merchants', 'MccController@merchants')->middleware('can.manage.mcc');
        Route::match(['get'], '/mcc/datatable', 'MccController@anyData')->name('get.search.mcc.codes')->middleware('can.manage.mcc');
        Route::match(['get'], '/mcc/remove', 'MccController@remove')->name('remove.mcc')->middleware('can.manage.mcc');
    });

});