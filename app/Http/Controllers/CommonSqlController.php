<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonSqlController extends Controller
{
    //写一些常用的sql
    public function sqlTest(){
        echo 'sql';
        $sql = 'select concat(id,name) as new_name from c_data_test';
        $sql = 'select group_concat(id,name SEPARATOR "|||") as group_name from c_data_test group by num';
        $sql = 'select TRIM(BOTH "44" from  group_concat(id,name SEPARATOR "|||") ) group_name from c_data_test group by num';
        //union all 连表
        $sql_2 = '';
        $res = \DB::select($sql);

        foreach($res as $k => $v){
            echo $v->group_name."<br/>";
        }
    }
    //子查询 聚合函数
    public function complex_sql(){

        $sql = 'select max(num) from (select * from (
                select id as mid,`name` as share_name,num as num  from c_data_test 
                union all 
                select id as mid,`name` as share_name,permission_id as num  from c_category
              ) as temp) temp_all';
        $sql2 = 'select * from (
                select id as mid,`name` as share_name,num as num  from c_data_test 
                union all 
                select id as mid,`name` as share_name,permission_id as num  from c_category
              ) as temp';
        $res = \DB::select($sql);
        $res2 = \DB::select($sql2);
        echo "<pre>";
        print_r($res);
        print_r($res2);
    }
    public function complex_sql2(){
        $sql = 'select IFNULL(
  concat(
      case when convert(left(max(id),2),unsigned) > 8 
      then 
      ""
      else 
      "0"
      end,
      max(id)+1),
    concat(
      case when "0" = ?
      then ""
      else ?
      end,
      "01")
    ) as maxId
from c_string_level
where parent = ?';
        $res = \DB::select($sql,['07','07','07']);//可用
        echo "<br/>";
        print_r($res);
    }
    public function complex_sql3(){
        $sql = 'select * from tb_name where to_days(created_at) = to_days(now())';//请求当天的数据
        $sql ='select * from tb_name where DATE_FORMAT(created_at,"%Y%m") = DATE_FORMAT(CURDATE,"%Y%m") ';//请求当前月份
        $sql = 'select * from tb_name where YEAR(create_at)=YEAR(now())';

    }
}
