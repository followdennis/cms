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
        dd($list);
        echo 'aaa';
    }
    public function show($id){
        //每次对访问刷新次数加一
        $content = LiZhi::find($id);
        //一个小操作，就可以进行监听
        Event::fire(new OrderShipped($content));

        echo $content->content;
        echo $content->click;
    }
    //chefs模型
    public function chefs(){
        $content = Chefs::first();

        Event::fire(new QueueTest($content));

        echo $content->chef_name;
        echo $content->like_num;
    }
}
