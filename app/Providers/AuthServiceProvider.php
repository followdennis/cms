<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //注册 发布/撤销 访问令牌 等需要的路由
        Passport::routes();
        //基本请求时间设置
        Passport::tokensExpireIn(Carbon::now()->addDays(1));

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(3));

    }
}
