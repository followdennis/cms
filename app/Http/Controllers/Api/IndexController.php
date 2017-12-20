<?php

namespace App\Http\Controllers\Api;

use App\Dog;
use App\LiZhi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index(Request $request){

        $data = Dog::where(function($query) use($request){
            if($request->filled('name')){
                $kw = trim($request->get('name'));
                $query->where('dog_name','like','%'.$kw.'%');
            }
        })->take(10)->get();
        return response()->json($data);
    }
    public function lists(Request $request){
        $perPage = !empty($request->get('perPage')) ? intval($request->get('perPage')) :10;
        $data = LiZhi::where(function($query) use($request){
            if($request->filled('name')){
                $kw = $request->get('name');
                $query->where('name','like','%'.$kw.'%');
            }
        })->paginate($perPage);
        $result = [
            'total'=>$data->total(),
            'perPage' => $data->perPage(),
            'currentPage' => $data->currentPage(),
            'lastPage' => $data->lastPage(),
            'from' => $data->firstItem(),
            'to' => $data->lastItem(),
            'items' => []
        ];
        if(!empty($data)){
            $items = [];
            foreach($data as $info){
                array_push($items,[
                    'id'=>$info->id,
                    'name'=>$info->name,
                    'title'=>$info->title,
                    'content'=>$info->content
                ]);
            }
            $result['items'] = $items;
        }
        return response()->json($result);
    }
}
