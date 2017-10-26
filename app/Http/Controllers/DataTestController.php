<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTestController extends Controller
{
    //
    public function search(Request $request){
        $method = empty($request->get('a')) ? 'get':$request->get('a');
        echo $method;
        $list = DB::table('data_test')->select('cate','num')->$method();
       //转换成阿拉伯数字 只能实现十万以内的数字转换
        $res = $this->toarabia('九万九千九百九十九');
        echo $res;
        //更大范围的数字转换
        $str = "一百八十七";
        $num = $this->ch2num($str);
        echo "<br/>";
        echo $num;
        $arr = array(
            array(
                1=>"qqqq",
                2=>"www",
                3=>"eee"
            )
        );

    }
    public function get_article(){
//        $data = DB::table('article_number as an')
//            ->leftJoin('data_test as dt','an.id','=','dt.id')
//            ->where('an.id','=',3468652)
//            ->first();

        $num = DB::table('article_number as an')->where('id',2868652)->first();
        $data = DB::table('data_test')->where('id',$num->id)->first();
        echo "<pre>";

        print_r($data);
    }
    //集合交集
    public function sets(){
        $a1 = [1,2,3,4,5];
        $a2 = [3,4,5,6];
        $col1 = collect($a1);
        $col2 = collect($a2);
        $intersect = $col1->intersect($a2)->toArray();
        echo "<Pre>";
        print_r($intersect);
    }

    function index(Request $request){
        //聚合排序
        $res = DB::table('data_test')
            ->select('cate',DB::raw('sum(num) as total'))
            ->groupBy('cate')
            ->orderBy('total','desc')
            ->get()->toArray();
//        $res = $request->except('_method');

        echo "<pre>";
//        print_r($res);
        //单词分界符
        $pattern = '~\bA\b~';
        $str="(A+AB+ABC+(B+BC))*A/B";
        echo $str."<br/>";
        $out = preg_replace($pattern,'',$str);
        print_r($out);
    }

    public function regular_test(){
        $path='#^[+/0-9A-Za-z]{21}[AQgw]==$#';
        $b='0ssfedfewfewfwefefewfA==#wefew';
        preg_match_all($path,$b,$out);

        print_r($out);
        echo '<br/>';
        $str = 'abcd';
        $pat = '#a#';
        $return = preg_match($pat,$str);
        print_r($str);
        $p = '#^(?:\w+\.)*?(\w+)\.(?:com.cn|cn|com|net)#';
        $str = 'baidu.com.cn';
        preg_match_all($p,$str,$out);
        print_r($out);
    }

    //辅助函数测试
    public function ftest()
    {
        //url使用的时候路由前面的部分
        echo url('ftest');
        echo '<br/>';
        //route 使用的是后面的as部分的内容
        echo route('f_test');
    }
    /**
     * 辅助函数
     */
    public function auxiliary()
    {
        //用方法反求出 url
        $url = action('DataTestController@index');
        echo 'action';
        echo $url;
        echo '<br/>url';
        echo url('user/profile',['id'=>1,'name'=>'xioaming']);//这样传递的内容，下标无效果
        echo '<br/>';
        echo 'route';
        echo "<br/>";
        echo route('test',['cate1'=>1,'cate2'=>'xiaoming','p'=>10]); //这种写法比较严格
        echo "<br/>";
        echo str_limit('处理完成，请处理', 8);
        echo '各种路径<br/>';
        echo public_path();
        echo "<br/>";
        echo storage_path();
        echo "<br/>";
        echo database_path();
        echo "<br/>";
        echo app_path();
        //retry 没什么效果
        echo "<br/>";
        echo "getByNameUri---这个会获取包括路由中的参数，但不包括可选参数  ？<br/>";
        echo app('router')->getRoutes()->getByName('test')->uri();

        $route = 'test/{cate1}-{cate2}-{p}.html';
        preg_match_all("/\{([\w+]+)\}/",$route,$route_var);
echo "<br/><pre>";
        print_r($route_var[1]);
echo "<br/>";
        $i = 0;
        retry(5,function() use($i){
            echo $i;
            echo '5';
        },1000);

    }

    /**
     * @param $str
     * @return int|mixed
     */
    public function toarabia($str){
        $num=0;
        $bins=array("零","一","二","三","四","五","六","七","八","九",'a'=>"个",'b'=>"十",'c'=>"百",'d'=>"千",'e'=>"万");
        $bits=array('a'=>1,'b'=>10,'c'=>100,'d'=>1000,'e'=>10000);
        foreach($bins as $key=>$val){
            if(strpos(" ".$str,$val)) $str=str_replace($val,$key,$str);
        }
        foreach(str_split($str,2) as $val){
            $temp=str_split($val,1);
            if(count($temp)==1) $temp[1]="a";
            if(isset($bits[$temp[0]])){
                $num=$bits[$temp[0]]+(int)$temp[1];
            }else{
                $num+=(int)$temp[0]*$bits[$temp[1]];
            }
        }
        return $num;
    }

    /**
     * 更大范围的中文转阿拉伯数字，实现
     */

    public function ch2num($str){
        //单位数组用于循环遍历，单位顺序从大到小
        $c = [
            '万亿'=>1000000000000,
            '亿' => 100000000,
            '万' => 10000,
        ];

        //中文替换数字规则，零没什么卵用；所以去掉
        $b = [
            '一' =>1,
            '二' =>2,
            '三' =>3,
            '四' =>4,
            '五' =>5,
            '六' =>6,
            '七' =>7,
            '八' =>8,
            '九' =>9,
            '零' =>'',
        ];

        //替换数字
        $str =  str_replace(array_keys($b), array_values($b), $str);
        //结果 7百7十8万亿4千7百2十亿7千5百7十万4千4百8十
        ////如果字符串以十开头，前边加1
        if(mb_strpos($str, '十' ,0 ,'utf-8') === 0)
            $str = '1'.$str;
        //初始化一个数组
        $arr[] = array(
            'str'    => $str, //字符串
            'unit'  => 1,     //单位
        );
        //将字符串按单位切分
        foreach ($c as $key => $value) {
            $brr = [];
            foreach ($arr as $item) {
                if(strpos($item['str'], $key)){
                    $sun = explode($key, $item['str'],2);
                    $brr[] = [
                        'str' => $sun[0],
                        'unit' => $value,
                    ];
                    $brr[] = [
                        'str' => $sun[1],
                        'unit' => $item['unit'],
                    ];
                }else{
                    $brr[] = $item;
                }
            }
            $arr = $brr;
        }
        /*    结果
            (
            [0] => Array
                (
                    [str] => 7百7十8
                    [unit] => 1000000000000
                )

            [1] => Array
                (
                    [str] => 4千7百2十
                    [unit] => 100000000
                )

            [2] => Array
                (
                    [str] => 7千5百7十
                    [unit] => 10000
                )

            [3] => Array
                (
                    [str] => 4千4百8十6
                    [unit] => 1
                )

            )*/

        //遍历求和
        $sum = 0;
        foreach ($arr as $item) {
            $sum += $this->getNum($item['str'],$item['unit']);
        }
        return $sum;
    }

    //将分组后的字符串转化成数字，并乘以单位
    public function getNum($str,$st){
        //倍数
        $a = [
            '千'=>1000,
            '百'=>100,
            '十'=>10
        ];
        //开始值
        $num = 0;
        //当前值所在位数
        $step = 1;
        //单位
        $un = 1;
        $arr =  preg_split('/(?<!^)(?!$)/u', $str);
        while (count($arr)) {
            $m = array_pop($arr);
            //如果是位数;更新倍数
            if(!empty($a[$m])){
                $step = $a[$m];
            }
            if(is_numeric($m)){
                $num += $m * $step;
            }
        }
        return $num * $st;
    }
}
