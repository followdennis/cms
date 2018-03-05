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
        $sql = 'select parent_id,count(*) as cnt from c_category group by parent_id having cnt>1';//having 方式的使用
        //这种是自己调用自己 in 的用法
        $sql = 'select * from c_category where parent_id in (select parent_id as cnt from c_category group by parent_id having count(*)>2)';
        //exists 的写法
        $sql = 'select * from c_category a where exists(select parent_id from c_category b group by parent_id having count(*)>1 and  a.parent_id=b.parent_id )';
        $res = \DB::select($sql);
        echo "<pre>";
        print_r($this->object2arr($res));

    }
    public function complex_sql4(){
        //删除字段的重复记录，保留主键的最小值 就是两个条件 在某个范围内，然后不在某个范围内
        $sql = 'delete from tb where people_id in (select people_id from tb group by people_id having  count(*) > 0) and id not in
        (select min(id) from tb group by people_id having count(*) > 0)';
    }

    public function complex_sql5(){
        //数据表的基本操作
        //增加字段
        $sql = 'alter table tb add column new1 varchar(12) default null';
        //删除字段
        $sql = 'alter table  tb drop column new2';
        //修改字段
        $sql = 'alter table tb modify new1 varchar(10)';
        //修改表明
        $sql = 'alter table tb rename tb2';
        //添加索引
        $sql = 'alter table tb add index emp_index(user_id)';
        //添加主关键字索引
        $sql = 'alter table tb add primary key(id)';
        //添加唯一索引
        $sql = 'alter table tb add unique user_name_index(user_name)';
        //删除某个索引
        $sql = 'alter table tb drop index emp_index';

    }

    //对象转换成数组
    public function object2arr($obj){
        $return = [];
        foreach($obj as $k => $v){
            if(is_object($v)){
                foreach($v as $kk => $vv){
                  $return[$k][$kk] = $vv;
                }
            }else{
                $return[$k] = $v;
            }
        }
        return $return;
    }

}
