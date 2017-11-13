<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueController extends Controller
{
    //
    public function index(){
        $list = \DB::table('lizhi')->select('id','title')->take(10)->get();
        return response()->json($list);
    }
}
