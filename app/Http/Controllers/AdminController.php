<?php

namespace App\Http\Controllers;

use App\Chefs;
use App\LiZhi;
use App\Project;
use App\RawData;
use App\Services\Tree;
use App\Services\Utils;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function index()
    {

        $rawdata = new RawData();

        $users = DB::table('lizhi')
            ->select('id','title','content','tags')
            ->get();

        $url = route('index',['cate1'=>'aaa','cate2'=>'bbb','p'=>10]);


        $curRoute = Route::Current()->getName();
        echo $curRoute;
//        dd(Route::Current());
//        dd($curRoute);
        echo $url;
        echo "<br/>";
        echo "数据库1";
//        echo Auth::user()->name;
//        echo Auth::user()['name'];
        echo "<br/>数据库2";
//        $m = new Project();
//        $list = $m->getProjectUser();
        $LiZhi = new LiZhi();
        $lizhi = $LiZhi->getList();
        foreach($lizhi as $k => $v ){
            echo $v->title;
            echo "<br/>";
        }
        $rd = $lizhi->map(function($item,$key){
             $item->title='这是标题';
             $item->content = '文章内容';
             $item->cate1 = '分类一';
            return $item;
        });
        echo "<br/>";
        echo "<pre>";
//        print_r($rd);
//        $info = DB::connection('mysql_center')->table('rawdata')->find(2);
//        $info = RawData::find(4)->toArray();
        echo "<br/>---";
//
//        echo \Request::route('a');
//        echo \Request::route('bbb');
        echo 'end';
        return view('admin.index',['users'=>$users]);
    }

    //实现菜单栏功能
    public function menu(){
        $list = DB::table('menus')
            ->orderBy('sort','asc')
            ->get()->toArray();
        echo "<pre>";
        $list_arr = [];
        foreach($list as $key => $val){
            if(is_object($val)){
                $list_arr[] = Utils::objectToArray($val);
            }else{
                $list_arr[] = $val;
            }
        }
        echo Hash::make('abcdefg');
        $catename = '分类1';
        $str = '<ul>
                    <li>$catename</li>
                    <li>2</li>
                    <li>3
                        <ul>
                            <li>3-2</li>
                            <li>3-3</li>
                            <li>3-1</li>
                        </ul>
                    </li>
                </ul>';

        $min = collect($list)->min();

        $tree = new Tree();
        $list = $tree->make_tree($list_arr);
        print_r($list);
        $tree->arr_foreach($list);

    }

    public function maketable(){
        $headers = ['title','content'];
        $project = LiZhi::all(['title','content'])->toArray();

    }
    public function test(Request $request,$cate1,$cate2,$p){

        //array_walk()使用方法
//        $arr = [
//            ['11','12','13','14'],
//            ['21','22','23','24'],
//            ['31','32','33','34']
//        ];
////        $arr = ['1','2','3','4','5','6','7'];
//        $a = 5;
//        $b = 22;
//        $new_arr = array_walk($arr,function(&$v,$k) use($a,$b){
//            if($v[0] > $b){
//                $v[0] = "ss".$v[0];
//            }
//        });
//        echo "<pre>";
//        print_r($arr);
        echo 'test';
        echo "<br/>";
        echo $cate1."-",$cate2."-".$p;

    }

    public function getdata(){

    }

    public function _query(){
            $condition = [
                'chef_name'=>'赵',
                'chef_phone'=>'130'
            ];

            $chef = new Chefs();
            array_walk($condition,function($v,$k)use(&$chef){
                $chef = $chef->where($k,'like',$v.'%');
            });

            $chef = $chef->take(5);
            $chefs = $chef->get()->toArray();
            echo "<Pre>";
            print_r($chefs);
        echo asset('storage/file.txt');
//        Storage::disk('local')->put('file.txt','Content');

    }

    public function setRedis(){
        $res = Redis::set('name','小明');
        if($res){
            echo '存储完成';
        }
    }

    public function getRedis(){
        $res = Redis::get('name');

        if($res){
            echo $res;
        }else{
            echo 'not find';
        }
    }


}
