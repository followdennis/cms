<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    //
    protected $connection='mysql_center';
    protected $table = 'user';

    public function getProjectUser(){
        $list = DB::table($this->table)
            ->get();
        return $list;
    }

}
