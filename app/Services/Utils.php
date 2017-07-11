<?php
namespace App\Services;
use Illuminate\Support\Facades\Route;

class Utils{
    public static function objectToArray($object){
        $object=(array)$object;
        foreach($object as $k=>$v)
        {
            if( gettype($v)=='resource' )
            {
                return ;
            }
            if( gettype($v)=='object' || gettype($v)=='array' )
            {
                $object[$k]=(array)self::objectToArray($v);
            }
        }
        return $object;
    }
}