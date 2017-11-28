<?php

namespace App\Http\Controllers;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class ElasticSearchController extends Controller
{
    public function create_index(){

        $client = new Client();
        $index['index'] = 'log';  //索引名称
        $index['type'] = 'ems_run_log'; //类型名称
        $data['body']['settings']['number_of_shards'] = 5;  //主分片数量
        $data['body']['settings']['number_of_replicas'] = 0; //从分片数量
        $client->indices()->create($index);
    }
    //插入索引数据
    public function index(){
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id',
            'body' => ['testField' => 'abc'] //可以是多字段
        ];
        $response = $client->index($params);
        echo "<pre>";
        print_r($response);
    }
    public function get_document(){
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id'
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
     * 3,或的查询条件      $index['body']['bool']['should'] = [['match'=>['mac'=>'abc']],['match'=>['product_id'=>20]]];
     * 4,非查询条件        只需修改 must_not 即可
     * 5,大于 等于 小于            $index['body']['query']['range'] = ['id' => ['gte' => 20,'lt'=>30]]
     */
    public function search_for_doc(){
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'body' => [
                'query' => [
                    'match' => [
                        'testField' => 'abc'
                    ]
                ]
            ],
            'size'=>10,   // 10条
            'from'=>200   // 从第200条开始
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
    //创建索引
    public function create_index(){
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'my_index',
            'body' => [
                'settings' => [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 0
                ]
            ]
        ];

        $response = $client->indices()->create($params);
        print_r($response);
    }
    //批量添加索引
    public function mass_add(){

    }

}
