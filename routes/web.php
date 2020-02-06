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

use App\Classes\LogicalModels\MailPostmanRepository;
use App\Classes\LogicalModels\MonobankPaymentsRepository;
use App\Classes\LogicalModels\PaymentsRepository;
use App\Models\MailerPostman;
use Carbon\Carbon;
use Illuminate\Support\Str;

Auth::routes();

Route::group(['middleware' => ['log.request']], function () {
    Route::group(['middleware' => ['auth', 'is.block.user']], function () {
        Route::get('/home', 'HomeController@index')->name('home'); // default page for auth useres
        Route::get('/', function () {

            return redirect('/login');
        });
//        Route::get('/changePassword','HomeController@showChangePasswordForm');
        Route::get('/user/password', 'SettingsController@changePassword');
        Route::post('/user/password/change', 'SettingsController@updatePassword');
        /**
         * Settings
         */
        Route::group(['prefix' => 'settings', 'middleware' => ['can.manage.roles']], function () {
            Route::get('/', 'SettingsController@index')->name('settings.index');
            Route::patch('/permissionsUpdate', 'SettingsController@permissionsUpdate');
            Route::patch('/overall', 'SettingsController@updateOverall');
            Route::match(['get'], '/users', 'UsersController@getList')->name('user.list');
            Route::group(['middleware' => ['can.add.user']], function () {
                Route::match(['get'], '/sendLink/{id}', 'UsersController@sendLink')->name('sendLink');
            });

            Route::match(['get'], '/applyRole', 'UsersController@applyRole');
            Route::match(['get'], '/statusUpdate', 'UsersController@statusUpdate');

        });
        Route::group(['prefix' => 'payments', 'middleware' => ['can.view.payments']], function () {
            Route::get('/', 'PaymentsController@index')->name('payments');
            Route::match(['get'], '/datatable', 'PaymentsController@anyData')->name('get.search.payment');
            Route::match(['get'], '/view', 'PaymentsController@getOneById');
            Route::match(['get'], '/getProcessLog', 'PaymentsController@getProcessLog');
            Route::match(['post'], '/changeStatusRequest', 'PaymentStatusRequestController@changeStatusRequest');
            Route::match(['get'], '/statusRequestList', 'PaymentStatusRequestController@list');
            Route::match(['post'], '/changeStatusResponse', 'PaymentStatusRequestController@changeStatusResponse');
        });

//        Route::group(['prefix' => '/snippets', 'middleware' => ['snippets.control']], function () {//todo middleware edit snippets

        Route::group(['prefix' => '/snippets', 'middleware' => ['snippets.control']], function () {

            Route::match(['get'], '/', 'SnippetController@index');
            Route::match(['post'], '/update', 'SnippetController@update');
            Route::match(['post'], '/store', 'SnippetController@store');
            Route::match(['post'], '/remove', 'SnippetController@remove');
            Route::match(['post'], '/routes/remove', 'SnippetRouteController@remove');

            Route::group(['prefix' => '{id}/routes'], function () {
                Route::match(['get'], '/', 'SnippetRouteController@index');
                Route::match(['post'], '/store', 'SnippetRouteController@store');
                Route::match(['post'], '/update', 'SnippetRouteController@update');


            });
        });
        Route::match(['get'], 'snip/list', 'SnippetRouteController@list');

        Route::group(['prefix' => 'merchants'], function () {

            Route::match(['get'], '/getlistByName', 'MerchantController@getlistByName'); // роут используется в поиске платежей
            Route::match(['get'], '/getMerchantsIdentifier', 'MerchantController@getMerchantsIdentifier'); // роут используется в поиске мерчантов
            Route::match(['get'], '/getConcordPayUserName', 'MerchantController@getConcordPayUserName'); // роут используется в поиске мерчантов

            Route::group(['middleware' => 'can.view.merchants'], function () {
                Route::match(['get'], '/viewChart', 'MerchantController@viewChart');//todo middleware
                Route::match(['get'], '/getChart', 'MerchantController@getChart');//todo middleware


                Route::match(['get'], '/{merchantId}/account/table', 'MerchantAccountController@getList');
                Route::match(['get'], '/', 'MerchantController@list');
                Route::match(['get'], '/datatable', 'MerchantController@anyData')->name('get.search.merchants');
                Route::match(['get'], '/{merchantId}', 'MerchantController@getOneById')->name('merchant.detail');
                Route::match(['post'], '/{merchantId}', 'MerchantController@update')->name('merchant.update');
                Route::match(['post'], '/', 'MerchantController@store')->name('merchant.create');
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
                    Route::match(['post'], '/store', 'MerchantRoutesController@store')->name('payment-route.store');
                    Route::match(['post'], '/update', 'MerchantRoutesController@update')->name('payment-route.update');
                    Route::match(['post'], '/update-priority', 'MerchantRoutesController@updatePriority');
                    Route::match(['get'], '/getAllowedRoutes/{paymentTypeId}', 'MerchantRoutesController@getAllowedRoutes');
                    Route::match(['post'], '/apply-snippet', 'MerchantRoutesController@applySnippet');
                });
                Route::group(['prefix' => '/route', 'middleware' => 'can.view.routes'], function () {
                    Route::match(['get'], '/table', 'MerchantRoutesController@getTable');
                });

                Route::group(['prefix' => '/limits', 'middleware' => 'can.manage.merchant.route'], function () {
                    Route::match(['get'], '/table', 'MerchantLimitsController@getTable');
                    Route::match(['post'], '/store', 'MerchantLimitsController@store')->name('payment-limit.store');
                    Route::match(['post'], '/update', 'MerchantLimitsController@update')->name('payment-limit.update');
                });

                Route::group(['prefix' => '/user-alias', 'middleware' => 'merchant.user.alias'], function () {
                    Route::match(['get'], '/table/{id}', 'MerchantUserAliasController@getTable');
                    Route::match(['post'], '/store', 'MerchantUserAliasController@store')->name('merchant-user-alias.store');
                    Route::match(['post'], '/update', 'MerchantUserAliasController@update')->name('merchant-user-alias.update');
                    Route::match(['post'], '/remove', 'MerchantUserAliasController@remove')->name('merchant-user-alias.remove');
                    Route::match(['get'], '/getMerchantsUserAlias', 'MerchantUserAliasController@getMerchantsUserAlias');
                });


                Route::group(['prefix' => '/apple-pay', 'middleware' => 'can.manage.applePay'], function () {
                    Route::match(['get'], '/{merchant_id}', 'ApplePayMerchantController@index');
                    Route::match(['get'], '/show', 'ApplePayMerchantController@show');
                    Route::match(['post'], '/remove', 'ApplePayMerchantController@remove')->name('apple-pay.remove');
                    Route::match(['post'], '/update', 'ApplePayMerchantController@update')->name('apple-pay.update');
                    Route::match(['post'], '/add', 'ApplePayMerchantController@store')->name('apple-pay.store');
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
            Route::match(['get'], '/merchant/{id}', 'StatisticController@merchant');
            Route::match(['get'], '/overAll', 'StatisticController@overAll');
            Route::match(['get'], '/topTen', 'StatisticController@topTen');
            Route::match(['get'], '/byRoutes', 'StatisticController@byRoutes');
        });

        Route::group(['prefix' => 'reestrs', 'middleware' => ['can.view.reestrs']], function () {
            Route::match(['get'], '/', 'ReestrController@index');
            Route::match(['get'], '/getReestr', 'ReestrController@getReestr');
        });


        Route::resource('mcc', 'MccController')->only([
            'index', 'store', 'edit', 'update', 'create'
        ])->middleware('can.manage.mcc');


        Route::match(['get'], '/mcc/{id_code}/merchants', 'MccController@merchants')->middleware('can.manage.mcc');
        Route::match(['get'], '/mcc/datatable', 'MccController@anyData')->name('get.search.mcc.codes')->middleware('can.manage.mcc');

        Route::match(['get'], '/mcc/remove', 'MccController@remove')->name('remove.mcc')->middleware('can.manage.mcc');


        Route::group(['prefix' => 'front', 'middleware' => ['can.view.front.users']], function () {
            Route::match(['get'], '/datatable', 'FrontUsersController@anyData')->name('get.front.users');
            Route::match(['get'], '/users', 'FrontUsersController@index');
            Route::match(['get'], '/user/{id}', 'FrontUsersController@show');
            Route::match(['get'], '/exportToCSV', 'FrontUsersController@exportToCSV');
        });

        Route::match(['get'], '/mcc/remove', 'MccController@remove')->name('remove.mcc')->middleware('can.manage.mcc');


        Route::group(['prefix' => 'monitoring', 'middleware' => ['can.view.monitoring']], function () {
            Route::match(['get'], '/', 'MonitoringController@index');
            Route::match(['get'], '/getPaymentLogOnline', 'MonitoringController@getPaymentLogOnline');
            Route::match(['get'], '/getTechData', 'MonitoringController@getTechData');
            Route::match(['get'], '/getPaymentLogArchive', 'MonitoringController@getArchiveData');
        });
    });
});
