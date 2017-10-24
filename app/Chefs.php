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
    public function dogs(){
        return $this->hasMany('App\Dog','owner_id');
    }



}
