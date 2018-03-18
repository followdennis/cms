<?php

namespace App\Http\Controllers;

use App\LiZhi;
use Illuminate\Http\Request;

class TableController extends Controller
{
    //
    public function index(){
        $data = LiZhi::orderBy('click','desc')->orderBy('id','desc')->take(5)->offset(10)->get();
        return view('table.index',compact('data'));
    }
    public function edit(Request $request){
        $params = $request->all();

//        $title = $request->get('title');
//        $name = $request->get('name');
//        $date = $request->get('date');
        return view('table.edit',['data'=>$params]);
    }
}
