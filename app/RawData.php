<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RawData extends Model
{
    //
    protected $connection = 'mysql_center';
    protected $table = 'rawdata';

    public function getInfoById($id){
        return DB::connection($this->connection)->table($this->table)->find($id);
    }

}
