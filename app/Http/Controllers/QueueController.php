<?php

namespace App\Http\Controllers;

use App\Jobs\SendReminderEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    //
    public function index(){

    }

    public function queue_test(){
        $user = User::find(1);
        $time = Carbon::now()->format('Y-m-d H:i:s');

        echo "开始队列消息测试".$time;

        $job = (new SendReminderEmail($user))
            ->delay(Carbon::now()->addMinutes(3));
        dispatch($job);
        $time = Carbon::now()->format('Y-m-d H:i:s');
        echo '结束'.$time;
    }
}
