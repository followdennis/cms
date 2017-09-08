<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    //
    public function index(){
        echo 'img';
        $manager = new ImageManager(['driver'=>'imagick']);
        $image = $manager->make('public/timg.jpg')->resize(300,200);

    }
}
