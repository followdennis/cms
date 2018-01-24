<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\OrderShipped' => [
            'App\Listeners\SendShipmentNotification',
        ],
        'App\Events\QueueTest' => [
            'App\Listeners\ManageQueueTest',
        ],
        'SocialiteProviders\Manager\SocialiteWasCalled'=>[
            'SocialiteProviders\Qq\QqExtendSocialite@handle',
            'SocialiteProviders\Weibo\WeiboExtendSocialite@handle'
        ],

    ];
    //将订阅者注册进来
//    protected $subscribe = [
//        'App\Listeners\UserEventSubscriber',
//    ];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //手动注册事件
//        Event::listent('event.name',function($foo,$bar){
//
//        });
    }
}
