<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //搜索功能实现
    public function index(){
        $table1 = [
            ['id'=>1,'content'=>'内容1','title'=>1],
            ['id'=>2,'content'=>'内容2','title'=>2],
            ['id'=>12,'content'=>'内容2','title'=>12],
            ['id'=>13,'content'=>'内容2','title'=>13],
            ['id'=>14,'content'=>'内容2','title'=>14],
            ['id'=>3,'content'=>'内容3','title'=>3]
        ];
        $table2 = [
            ['id'=>4,'content'=>'内容4','title'=>4],
            ['id'=>5,'content'=>'内容5','title'=>5],
            ['id'=>15,'content'=>'内容15','title'=>15],
            ['id'=>16,'content'=>'内容16','title'=>16],
            ['id'=>17,'content'=>'内容17','title'=>17],
            ['id'=>6,'content'=>'内容6','title'=>6]
        ];
        

    }
}
