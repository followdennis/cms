<?php

namespace App\Http\Controllers;

use App\Dog;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class ElasticSearchController extends Controller
{
    //创建索引
    public function make_index(){

        $client = ClientBuilder::create()->build(); //客户端的调用用该用这个方法
        $index['index'] = 'my_index';  //索引名称
//        $index['type'] = 'ems_run_log'; //没有这个类型
        $data['body']['settings']['number_of_shards'] = 5;  //主分片数量
        $data['body']['settings']['number_of_replicas'] = 0; //从分片数量
        $client->indices()->create($index);
        echo "创建完成";
    }
    //插入索引数据
    public function index(Dog $dog){
        $client = ClientBuilder::create()->build();
//        $params = [
//            'index' => 'my_index',
//            'type' => 'my_type',
//            'id' => 'my_id',
//            'body' => ['testField' => 'abc'] //可以是多字段
//        ];
//        $response = $client->index($params);
        $params = array();
//        $params['index'] = 'my_index';
//        $client->indices()->delete($params);

        $list = $dog->getList();
        foreach($list as $k => $v){
            $params = array();
            $params['body'] = [
                'dog_name'=>$v->dog_name,
                'owner_name'=>$v->owner_name,
                'owner_id' => $v->owner_id
            ];
            $params['index'] = 'my_index';
            $params['type'] = 'my_type';
            $params['id'] = $v->id;
            $client->index($params);
        }
        echo "创建索引完成";
    }
    //获取文档  测试成功
    public function get_document(){
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => '3'
        ];

        $response = $client->get($params);
        echo "<pre>";
        print_r($response);
    }


    /**
     * 查询中的集中写法
     * 1，某个字段等于某值  $index['body']['queyr']['mathch']['mac'] = 'aaa';
     * 2, 与条件的写法     $index ['body']['query']['bool']['must'] = [
     *                                      ['match'=>['mac'=>'abc']],
     *                                       ['match'=>['product_id'=>20]]
     *                              ];
     * 3,或的查询条件     $index['body']['query']['bool']['should'] = [['match'=>['mac'=>'abc']],['match'=>['product_id'=>20]]];
     * 4,非查询条件        只需修改 must_not 即可
     * 5,大于 等于 小于            $index['body']['query']['range'] = ['id' => ['gte' => 20,'lt'=>30]]
     */
    public function search_for_doc(){
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'body' => [
                'query'=>[
                    'bool'=>['should'=>[
                        ['match'=>['dog_name'=>'dahuang']],
                        ['match'=>['dog_name'=>'August']],
                        ['match'=>['dog_name'=>'Shanel']],
                        ['match'=>['dog_name'=>'tony']]

                    ]]
                ]
            ],
//            'size'=>10,   // 10条
//            'from'=>200   // 从第200条开始
        ];

        $response = $client->search($params);
        echo "<pre>";
        print_r($response);
    }
    //删除文档
    public function del_doc(){
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id'
        ];

        $response = $client->delete($params);
        echo "<pre>";
        print_r($response);
    }
    //删除索引
    public function del_index(){
        $client = ClientBuilder::create()->build();
        $deleteParams = [
            'index' => 'my_index'
        ];
        $response = $client->indices()->delete($deleteParams);
        print_r($response);
    }

    //批量添加索引
    public function mass_add(){
        $client = new Client();
        for($i = 0; $i < 100; $i++) {
            $params['body'][] = array(
                'index' => array(
                    '_id' => $i
                )
            );

            $params['body'][] = array(
                'my_field' => 'my_value',
                'second_field' => 'some more values'
            );
        }
        $responses = $client->bulk($params);

    }


}
