<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreeController extends Controller
{
    protected  $tmp = array(
        array('cate_id'=>1 , 'name'=>'首页' , 'parent_id'=>'0'),
        array('cate_id'=>2 , 'name'=>'新闻中心' , 'parent_id'=>'1'),
        array('cate_id'=>3 , 'name'=>'娱乐新闻' , 'parent_id'=>'2'),
        array('cate_id'=>4 , 'name'=>'军事要闻' , 'parent_id'=>'2'),
        array('cate_id'=>5 , 'name'=>'体育新闻' , 'parent_id'=>'2'),
        array('cate_id'=>6 , 'name'=>'博客' , 'parent_id'=>'1'),
        array('cate_id'=>7 , 'name'=>'旅游日志' , 'parent_id'=>'6'),
        array('cate_id'=>8 , 'name'=>'心情' , 'parent_id'=>'6'),
        array('cate_id'=>9 , 'name'=>'小小说' , 'parent_id'=>'6'),
        array('cate_id'=>10 , 'name'=>'明星' , 'parent_id'=>'3'),
        array('cate_id'=>11 , 'name'=>'网红' , 'parent_id'=>'3')
    );
    protected $newtree = [];
    //
    public function index(){

    }
    public function tree(){

    }
}
