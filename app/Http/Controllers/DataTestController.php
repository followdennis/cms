<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTestController extends Controller
{
    //
    function index(){
        $res = DB::table('data_test')
            ->select('cate',DB::raw('sum(num) as total'))
            ->groupBy('cate')
            ->orderBy('total','desc')
            ->get()->toArray();
        echo "<pre>";
        print_r($res);
    }
}
