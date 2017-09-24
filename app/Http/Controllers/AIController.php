<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Phpml\Classification\KNearestNeighbors;

class AIController extends Controller
{
    //机器学习初步探索
    public function index(){
        echo 'ai';
        $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
        $labels = ['a', 'a', 'a', 'b', 'b', 'b'];

        $classifier = new KNearestNeighbors();

        $classifier->train($samples, $labels);

        $data = $classifier->predict([3, 2]);
        echo $data;
    }
}
