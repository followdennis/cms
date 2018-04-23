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
        //日期天
        $sql1 = "select date_format(created_time,'%Y-%m-%d') as day from tb_name";
        //获取时间戳类型
        $sql2 = "select from_unixtime(create_time,'%Y-%m-%d') from tb_name";
        //返回多个总数
        $sql3 = "select count(*) all ,";
        $sql3 .= " count(case when status = 1 then status end) status_1_num,";
        $sql3 .= "count(case when status = 2 then status end) status_2_njm";
        $sql3 .= " from tb_name";
        //替换某字段的内容
        $sql4 = "update tb_name set content = replace (content, 'aaa', 'bb') where condi";
        //获取某字段包含字符串的数据
        $sql5 = "select * from tb_name where locate('关键字',字段名)";
        //获取字段中的前思维
        $sql6 = "select substring(字段名,1,4) from tb_name";
        //查找表中多余的重复记录
        $sql7 = "select * from tb_name where 字段名 in ";
        $sql7 .= "(select 字段名 from tb_name group by 字段名 having count(ziduanming) > 1)";
        //求数字的连续范围
        $sql8 = "select min(number) start_range , max(number) end_range from 
              (
                select number ,rn,number-rn diff from 
                (
                  select number,@number := @number + 1 rn from test_number ,
                  ( select @number := 0) as number 
                ) b
              ) c group by diff";

        //一条语句生成多条测试数据
        $sql9 = "insert into test_sign_history (uid,create_time) 
select ceil(rand()*10000),str_to_date('2016-12-11','%Y-%m-%d') + interval ceil( rand()*10000) minute 
from test_nums where id <31";

        //统计每天每小时的用户签到情况
        $sql = "select h,sum
        (
            case when create_time = '2016-12-11' then c else 0 end
        ), 11sign ,sum
        (
            case when create_time = '2016-12-12' then c else 0 end
        ) 12sign,,sum
        (
            case when create_time = '2016-12-13' then c else 0 end
        ) 13sign from
        (
          select date_format(create_time,'%Y-%m-%d') create_time,
          hour(create_time) h,
          count(*) C from test_sign_history 
          group by 
          date_format(create_time,'%Y-%m-%d'),
          hour(create_time)
        ) a group by h with rollup";

        //统计每天的每小时用户签到情况（当每个小时没有数据是为0）
        $sql = "select type 
        sum(case when create_time ='2016-12-11' then c else 0 end) 11sign,
        sum(case when create_time = '2016-12-12' then c else 0 end) 12sign,
        sum(case when create_time = '2016-12-13' then c else 0 end) 13sign
        from (
          select date_format(create_time ,'%Y-%m-%d') create_time,
          count(*) c 
          from test_sign_history
          group by 
          date_format(create_time ,'%Y-%m-%d')
          b 
          left join
          (
            select date_format(create_time,'%Y-%m-%d') create_time,
            count(*) c 
            from test_sign_history
            group by
            date_format(create_time,'%Y-%m-%d')
          ) c on (b.create_time =c.create_time + interval 1 day)
          union all 
          select date_format(create_time,'%Y-%m-%d') create_time,
          count(*) c ,'current'
          from test_sign_history 
          group by date_format(create_time,'%Y-%m-%d')
        ) a 
        group by typeorder by case when type='current' then 1 else 0 end desc";

        //统计每天签到数相同的用户
        $sql = "select 
        sum(case when day =1 then cn else 0 end) 1day,
        sum(case when day =2 then cn else 0 end) 2day,
        sum(case when day = 3 then cn else 0 end) 3day,
        sum(case when day = 3 then cn else 0 end) 4day
        from
        (
          select c day ,count(*) cn from
          (
            select uid,count(*) c from test_sign_history group by uid
          ) a 
          group by c
        ) b";

        //统计每天签到数相同的用户
        $sql = "select * from 
        (
          select d.*,
          @ggid := @cggid,
          @cggid := d.uid,if(@ggid = @cggid, @grank := @grank +1, @grank := 1)
          grank
          from 
          (
            select uid,min(c.create_time)
            begin_date , max(c.create_time) end_date,count(*) count from 
            (
              select b.*,
              @gid := @cgid,
              @cgid := b.uid,if(@gid = @cgid,@rank := @rank + 1,@rank := 1)rank,
              b.diff -@rank flag FROM (
                select distinct uid,
                date_format(create_time,'%Y-%m-%d') create_time,
                datediff(create_time,now()) diff
                from test_sign_history order by uid,create_time) b ,
                (
                  select @gid :=1,@ci=gid:=1,@rank:=1) as a
                ) c group by uid,flag order by uid,count(*) desc
              ) d,(select @ggid := 1, @cggid := 1, @grank :=1) as e
            ) fwhere grank = 1";

    }

    public function complex_sql6(){
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
