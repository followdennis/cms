<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    //
    public function index(){


        $manager = new ImageManager(array('driver' => 'imagick'));

// to finally create image instances
        $image = $manager->make(asset('timg.jpg'))->resize(200, 200);
        $image->save('new_avatar.jpg');
    }
}
