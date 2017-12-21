<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['namespace'=>'Api','middleware'=>'api'],function(){
    Route::get('auto_complete',['uses'=>'IndexController@index']);
    Route::any('get_list',['uses'=>'IndexController@lists']);
    Route::post('get_list/del',['uses'=>'IndexController@del']);
    Route::post('get_list/edit',['uses'=>'IndexController@edit']);
    Route::post('get_list/add',['uses'=>'IndexController@add']);
});


