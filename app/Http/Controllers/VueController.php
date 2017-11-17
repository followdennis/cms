<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueController extends Controller
{
    //
    public function index(){
        $list = \DB::table('lizhi')->select('id','title')->paginate(10);
        $links = $list->links('vendor.pagination.default')->toHtml();
        $response = array(
            'list'   => $list->toArray()['data'],
            'page' => array(
                'total'        => $list->total(),
                'per_page'     => $list->perPage(),
                'current_page' => $list->currentPage(),
                'last_page'    => $list->lastPage(),
                'from'         => $list->firstItem(),
                'to'           => $list->lastItem()
            ),
            'links'=>$list->links('vendor.pagination.default')->toHtml()
        );
        return response()->json($response);
    }
}
