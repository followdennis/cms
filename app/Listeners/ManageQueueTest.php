<?php

namespace App\Listeners;

use App\Events\QueueTest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ManageQueueTest implements ShouldQueue
{
    /**
     * 任务将被推送到的连接名称
     */
    public $connection = 'sync';
//    public $connection = 'sqs';

    public $queue = 'listeners';
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QueueTest  $event
     * @return void
     */
    public function handle(QueueTest $event)
    {
        //
        $chefs = $event->chefsEvent;
        $chefs->like_num = $chefs->like_num + 1;
        $chefs->save();

    }

    /**
     * 处理任务失败
     */
    public function failed(QueueTest $event,$exception)
    {
        //如果任务处理失败，则调用
    }
}
