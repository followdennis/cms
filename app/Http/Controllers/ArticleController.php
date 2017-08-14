<?php

namespace App\Http\Controllers;

use App\Events\OrderShipped;
use App\LiZhi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class ArticleController extends Controller
{
    //
    public function index(LiZhi $lizhi){
        $list = $lizhi->getList();

    }
    public function show($id){
        //每次对访问刷新次数加一
        $content = LiZhi::find($id);
        Event::fire(new OrderShipped($content));
        echo $content->content;
        echo $content->click;
    }
}
