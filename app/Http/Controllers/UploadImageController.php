<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImageController extends Controller
{
    //
    public function index(){
        return view('image.index');
    }

    //非ajax上传文件
    public function index_basic(Request $request){

        if($request->isMethod('POST')){

//            Storage::disk('uploads')->put('msg.txt','hahaha');
            //这种方法，可创建文件夹
//            Storage::disk('uploads')->put('avatars/1','dir');
//            $path = Storage::putFile('avatars',$request->file('file1'));
              $extension = $request->file('file1')->extension();
              $name = Carbon::now()->format('YmdHis');
              $new_file_name = $name.'abc.'.$extension;
              echo $new_file_name;
              $path = $request->file('file1')->storeAs('avatars',$new_file_name,'uploads');
            echo $path.'aaa';
        }
//        $url = Storage::disk('uploads')->url('abc.jpg');

//        $size = Storage::disk('uploads')->lastModified('file.txt');

        return view('image.index_basic');
    }

    public function del_file(){
        //可以删除
//        Storage::delete('avatars/46Wa9M7dIOhmnn40iX5FsjTHBuohaL080sGOOVru.jpeg');
//        Storage::deleteDirectory('avatars');
        echo "删除文件或删除文件夹";
    }

    public function all_files(){
        $files = Storage::disk('uploads')->files();
        $files = Storage::disk('uploads')->allFiles();
        dd($files);
    }
}
