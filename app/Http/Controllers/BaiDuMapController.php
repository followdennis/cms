<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaiDuMapController extends Controller
{
    //

    public function index(){
        echo "测试百度地图";

        $url = 'http://api.map.baidu.com/place/v2/search?';
        $data = [

            'q'=>'银行',
            'region'=>'北京',
            'output'=>'json',
            'page_num'=>1,
            'page_size'=>20,
            'ak'=>'5pZYl6ocvl75arR720O7hOxo4C9UfGQH'];


        $data = [
            'query'=>'银行$酒店',
            'page_site'=>10,
            'page_num'=>5,
            'scope'=>1,
            'location'=>'39.918,116.404',
            'radius'=>2000,
            'output'=>'json',
            'ak'=>'5pZYl6ocvl75arR720O7hOxo4C9UfGQH'
        ];

        $url = $url.$this->query_condition($data);
        echo "<pre>";
        $html = $this->https($url);
        echo $html;
    }
    public function query_condition($data = array()){
        if(empty($data)){
            return '';
        }
        $str = '';
        foreach($data as $k=>$v){
            $str .= $k.'='.$v.'&';
        }
        return rtrim($str,'&');
    }

    /**
     * @param $url
     * @return mixed
     * 可用
     */
    function https($url ,$timeout = 30,$post = false){
//        $url = $url."?".http_build_query($data);
//        echo $url;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl,CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
        /*添加*/
        curl_setopt($curl, CURLOPT_POST, $post);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        /*添加结尾*/
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }
}
