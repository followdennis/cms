<?php

namespace App\Http\Controllers;

use App\Chefs;
use App\Events\OrderShipped;
use App\Events\QueueTest;
use App\LiZhi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class ArticleController extends Controller
{
    //
    public function index(LiZhi $lizhi){
        $list = $lizhi->getList();

        echo 'aaa';
        $pattern = '~\bA\b~';
        $str="(A+AB+ABC+(B+BC))*A/B";
        $out = preg_replace($pattern,$str,'aaaabbc');
        print_r($out);

    }
    public function show($id){
        //每次对访问刷新次数加一
        $content = LiZhi::find($id);

        //一个小操作，就可以进行监听
//        Event::fire(new OrderShipped($content));
        event(new OrderShipped($content));
        echo $content->content;
        echo $content->click;

    }
    //chefs模型
    public function chefs(){
        $content = Chefs::first();

        event(new QueueTest($content));
        echo $content->id;
        echo $content->chef_name;
        echo $content->like_num;
    }
}
