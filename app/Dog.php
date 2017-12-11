<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    //
    protected $table = 'dogs';

    protected $guarded = [];
    public function owner(){
        return $this->belongsTo('App\Chefs','owner_id');
    }
    public function getList(){
        return self::get();
    }
    public function getOne(){
        return self::where('owner_id',10)->first();
    }
}
