<?php

namespace App\Http\Controllers;

use App\Chefs;
use App\LiZhi;
use App\Project;
use App\RawData;
use App\Services\Tree;
use App\Services\Utils;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    protected  $str;
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
    //
    public function index()
    {

        $rawdata = new RawData();

        $users = DB::table('lizhi')
            ->select('id','title','content')
            ->get();

//        $url = route('index',['cate1'=>'aaa','cate2'=>'bbb','p'=>10]);


//        $curRoute = Route::Current()->getName();
//        echo $curRoute;
        echo "<br/>";
//        dd(Route::Current());
//        dd($curRoute);
//        echo $url;
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
            $item->key = $key;
            return $item;
        });
        dd($rd);
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

    /**
     * 生成带html标签的树形菜单
     */
    public function tree_html(){
        $tmp = $this->tmp;
        echo "<ul>
                <li><a>一级分类</a>
                    <ul>
                        <li><a href='#'>二级分类</a></li>
                    </ul>
                </li>
                <li><a>一级分类</a></li>
                <li><a>一级分类</a></li>
              </ul>";
        echo "<pre>";
        $menu = $this->tree($tmp,0,0);
        print_r($menu);
        $this->makehtml($menu);
        echo $this->str;
    }
    public function makehtml($arr = array()){
        if(!is_array($arr)){
            return false;
        }
        $this->str .= '<ul>';
        foreach($arr as $k => $v){

            if(isset($v['children'])){
                $this->str .= "<li>".$v['name']."</li>";
                $this->makehtml($v['children']);
            }else{
                $this->str .= "<li><a href='#'>".$v['name']."</a>";
            }
        }
        $this->str .= "</ul>";

    }
    //实现菜单栏功能
    public function menu(){
//        $a = [
//            0 => ['a'=>'111'],
//            1 => ['a' =>'bbb'],
//            2 => ['a'=>'ccc'],
//            3 => ['a' =>'ddd']
//        ];
//        $return = array_where($a,function($v,$k){
//            return $v['a'] == '111';
//        });
        //array_where()是过滤数组的作用
//        print_r($return);exit;


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


        $tree = new Tree();
        $list = $tree->make_tree($list_arr);
        print_r($list);
        $tree->arr_foreach($list);

    }

    public function tree_test(){
//        $arr = [
//            ['id'=>'1','parent_id'=>'0','name'=>'一级分类'],
//            ['id'=>'2','parent_id'=>'1','name'=>'二级分类'],
//            ['id'=>'3','parent_id'=>'2','name'=>'三级分类']
//        ];
        $tmp = array(
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

        echo "<pre>";

        $tree = $this->Ancestry($tmp,11);
        print_r($tree);
        $str = '';

        foreach($tree as $key => $val){
            $str .= $val['name'].'>';
        }

        echo trim($str,'>');


    }
    public function tree($arr , $parentId = 0 ,$level = 0, $pk = 'cate_id'){

        $children = array_filter($arr ,function($val) use($parentId){
            return $val['parent_id'] == $parentId;
        });

        $pc = [];
        foreach($children as $child){
            $cpid = $child[$pk];
            $grandson = $this->tree($arr,$cpid,$level+1);
            $newChild = $child;
            $newChild['text'] = $child['name'];
            $newChild['level'] = $level;
            if(!empty($grandson)){
                $newChild['children'] = $grandson;
            }
            array_push($pc,$newChild);
        }
        return $pc;
    }
    public function tree2_test(){
        $tmp = $this->tmp;
        $tree = $this->tree2($tmp,0);
        echo "<pre>";
        print_r($tree);
    }
    public function tree2($data , $id = 0,$lev = 0, $pk = 'cate_id'){
        static $son = array();
        foreach($data as $key => $val){
            if($val['parent_id'] == $id){
                $val['lev'] = $lev;
                $son[] = $val;
                $this->tree2($data, $val['cate_id'] , $lev+1);
            }
        }
        return $son;
    }
    /**
     * 寻找祖先
     */
    public function Ancestry($data,$pid,$pk = 'cate_id'){
        static $ancestry = [];
        foreach($data as $key => $val){
            if($val[$pk] == $pid){
                //下面两行调换会改变顺序
                $this->Ancestry($data, $val['parent_id']);
                $ancestry[] = $val;
            }
        }
        return $ancestry;
    }

    public function maketable(){
        $headers = ['title','content'];
        $project = LiZhi::all(['title','content'])->toArray();

    }
    public function test(Request $request,$cate1,$cate2,$p){
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
    //redis缓存
    public function cache_set(){
            if(Cache::store('redis')->put('cache_name','wang',1)){
                echo 'ok';
            }else{
                echo 'fail';
            }

    }
    public function cache_get(){
        if(Cache::store('redis')->has('cache_name')){
            echo Cache::store('redis')->get('cache_name');
        }else{
            echo 'no i have no data';
        }

    }

}
