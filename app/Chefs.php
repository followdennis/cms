<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chefs extends Model
{
    //
    protected $table = 'chefs';

    public function getInfoById($id){
        return self::find($id);
    }


}
