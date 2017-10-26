<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chefs extends Model
{
    //
    protected $table = 'chefs';

    public function getInfoById($id){
        return self::find($id);
    }

    public function insertData($params = array()){
        $save = DB::table($this->table)->insert($params);
        if($save){
            return true;
        }else{
            return false;
        }
    }

    //调用这个方法不需要用括号,而且返回的实例也只是dog的实例
    public function dog(){
        return $this->hasOne('App\Dog','owner_id');
    }
    //hasmanny和hason差不多
    public function dogs(){
        return $this->hasMany('App\Dog','owner_id');
    }
    //多对多的关系
    //belongsToMany
    public function manydogs(){
//        return $this->belongsToMany('App\Dog','中间表名字','关联id','关联id');
//        pivot属性 只有主键才可以通过pivot来调用，否则要指定一下 ->withPivot('colomn1','column2');
    }



}
