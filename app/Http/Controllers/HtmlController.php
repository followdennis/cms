<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HtmlController extends Controller
{
    //
    public function index(){

        $data = [
            ['number'=>10,'city'=>'北京'],
            ['number'=>5,'city'=>'上海'],
        ];
        $html = $this->makehtml($data);
        echo $html;
    }
    public function makehtml($data){
        $h1 = "<ul class='style'>";

        $str = $h1.'';
        foreach($data as $k  => $v){
            $str .= sprintf("<li onclick='alert(\"ok\")'>there are %u million cars in %s </li>",$v['number'],$v['city']);
        }
        $str  .= "</ul>";
        return $str;
    }
}
