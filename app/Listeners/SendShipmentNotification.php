<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendShipmentNotification
{
    protected $session;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
//        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        //使用$event->order 发访问订单
        $lizhi = $event->lizhiEvent;
        $lizhi->click = $lizhi->click + 1;
        $lizhi->save();

    }

}
