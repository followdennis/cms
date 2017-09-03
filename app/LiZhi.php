<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LiZhi extends Model
{
    //
    protected $table = 'lizhi';

    public function getList(){
        return DB::table($this->table)
            ->get();
    }
}
