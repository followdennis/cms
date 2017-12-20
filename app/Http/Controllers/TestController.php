<?php

namespace App\Http\Controllers;

use App\Dog;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise;
use Symfony\Component\DomCrawler\Crawler;

class TestController extends Controller
{

    public function update_test(Dog $dog){
        return response()->json([1,2,3]);
        $owner_name = 'owner2';
        //返回实例
//        $dog = Dog::firstOrCreate(['dog_name'=>'Burley Herman IV','owner_id'=>5,'owner_name'=>$owner_name]);
        //返回实例
        $dog = Dog::updateOrCreate(['owner_name'=>'owner3'],['owner_id'=>1,'dog_name'=>'hobo']);
        echo $dog->id;
        echo "<br/>";
        $data = $dog->getOne();
        dd($data);
    }
    public function time_test(){
        echo 'test<br/>';
        $str = "11/09/2017";
        $new = Carbon::parse($str)->format("Y-m-d H:i:s");
        $list = \DB::table('dogs')->where('created_at','>',$new)->get();
        echo "<br/>";
        echo $list->count();
        echo "<br/>";
        echo $new;
    }
    public function test_validate(\Illuminate\Http\Request $request){
        $params = [
            'name'=>'小明',
            'age'=>'你好',
            'address'=>'南京南京南京南京南京南京南京'
        ];
//        $this->validate($params,[
//            'name'=>'required|max:255|',
//            'age'=>'required|integer|max:255',
//            'address'=>'requred|max:5'
//        ]);
        $validator = Validator::make($params,[
            'name'=>'required|max:255',
            'age'=>'required|integer',
            'address'=>'required|max:10'
        ]);
        if($validator->fails()){
            return $validator->errors();
        }




    }
    public function test_serialize(){
        $arr = [
            'name'=>'xiaoming',
            'age'=>30,
            'sex'=>'男'
        ];
        $str = serialize($arr);
        echo $str;
        $str2 = unserialize($str);
        echo "<br/>";
        echo "<pre>";
        print_r($str2);
    }
    public function test_unserialize(){

    }
    //登录测试
    public function login_test1(){

    }

    //登录测试
    public function login_test2(){

    }

    //登录测试
    public function login_test3(){

    }
    //
    public function test(){


//        $url = 'www.baidu.www.com.cn';
//        $pattern = '/^(?:\w+\.)*?(\w+)\.(?:com.cn|cn|com|net)/';
//        echo $url.'<br/>';
////        $url = preg_replace('/^www\./','',$url);
//        preg_match($pattern,$url,$out);
//        print_r($out);
//        echo explode('.',$url)[0];

        config(['app.timezone'=>'America/Chicago']);
        $value = config('app.timezone');
        echo $value;

        $url = 'www.baidu.www.com.cn';
        $pattern = '/^(?:\w+\.)*?(\w+)\.(?:com.cn|cn|com|net)/';
        echo $url.'<br/>';
//        $url = preg_replace('/^www\./','',$url);
        preg_match($pattern,$url,$out);
        print_r($out);
        echo explode('.',$url)[0];
        $a = 'amp';
        $b = 'lampb';
        $res = strcmp($a,$b);


        echo "<hr>";
        echo $res;
        switch($res){
            case 1:
                echo '1';
                break;
            case -1:
                echo '2';
                break;
            case 0:
                echo '3';
                break;
            default:
                echo '4';
        }
//        Log::emergency('aaa');
//        Log::alert('bbb');
//        Log::critical('ccc');
//        Log::error('dd');
//        Log::warning('ee');
//        Log::notice('ff');
//        Log::info('aagga');
//        Log::debug('qq');


    }
    public function spider_test(){
       $client = new Client();

        $crawl = new Crawler();
        $url = 'http://www.baidu.com/';
        $http = $client->request('GET',$url);
        if ($http->getStatusCode() == 200) {
            // 判断 http 状态码为 200 的时候，执行成功
            // echo $http->getBody();
             echo $http->getBody()->getContents();
        }
    }
    public function spider(){
        $client = new Client();
        $requests = function ($total) {
            $uri = 'http://qulishi.com';
            for ($i = 0; $i < $total; $i++) {
                yield new Request('GET', $uri);
            }
        };
        $pool = new Pool($client, $requests(10), [
            'concurrency' => 5,
            'fulfilled' => function ($response, $index) {
                // this is delivered each successful response
//                $res = json_decode($response->getBody()->getContents());
                if($response->getStatusCode() == 200){
                    echo $response->getBody()->getContents();
                }
            },
            'rejected' => function ($reason, $index) {
                // this is delivered each failed request
                $this->error("rejected" );
                $this->error("rejected reason: " . $reason );
            },
        ]);
        // Initiate the transfers and create a promise
        $promise = $pool->promise();
        // Force the pool of requests to complete.
        $promise->wait();
    }

    public function red_packet(){
        $total=20;//红包总金额
        $num = 10;// 分成10个红包，支持10人随机领取
        $min = 0.01;//每个人最少能收到0.01元
        for ($i=1;$i<$num;$i++)
        {
            //最少预留九分
            $safe_total=($total-($num-$i)*$min)/($num-$i);//随机安全上限

            $money=mt_rand($min*100,$safe_total*100)/100;
            $total=$total-$money;
            echo '第'.$i.'个红包：'.$money.' 元，余额：'.$total.' 元 ';
            echo "<br/>";
        }
        echo '第'.$num.'个红包：'.$total.' 元，余额：0 元';

    }

    public function route_test($province = 'jiangsu',$city='',$district = ''){
        echo '路由测试';
        echo $province.'-'.$city.'-'.$district;
        echo "<br/>";
        echo $curRoute = Route::Current()->getName();
    }

}
class A{
    public $num = 100;
}
