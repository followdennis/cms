<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise;
use Symfony\Component\DomCrawler\Crawler;

class TestController extends Controller
{
    //
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

}
