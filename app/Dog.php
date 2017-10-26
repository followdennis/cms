<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    //
    protected $table = 'dogs';


    public function owner(){
        return $this->belongsTo('App\Chefs','owner_id');
    }
}
