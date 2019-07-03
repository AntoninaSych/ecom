<?php

namespace App\Http;

use App\Http\Middleware\CanApplyMerchantsRequest;
use App\Http\Middleware\CanManageMerchantPaymentType;
use App\Http\Middleware\CanManageMerchantRoute;
use App\Http\Middleware\CanMccCodes;
use App\Http\Middleware\CanViewMerchants;
use App\Http\Middleware\CanViewPayments;
use App\Http\Middleware\CanViewReestrs;
use App\Http\Middleware\CanViewStatistic;
use App\Http\Middleware\IsBlockUser;
use App\Http\Middleware\LogRequest;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,
//        'user.is.admin' => \App\Http\Middleware\RedirectIfNotAdmin::class, //remove we use permissions
        'can.add.user' => \App\Http\Middleware\CanAddUser::class,
        'can.manage.roles' => \App\Http\Middleware\CanManageUsers::class,
        'can.view.payments' => CanViewPayments::class,
        'is.block.user' => IsBlockUser::class,
        'can.view.merchants' =>CanViewMerchants::class,
        'can.manage.mcc' => CanMccCodes::class,
        'can.apply.merchants.request' =>CanApplyMerchantsRequest::class,
        'log.request' => LogRequest::class,
        'can.manage.merchant.payment.type' => CanManageMerchantPaymentType::class,
        'can.manage.merchant.route'=>CanManageMerchantRoute::class,
        'can.view.statistics' => CanViewStatistic::class,
        'can.view.reestrs' => CanViewReestrs::class
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
