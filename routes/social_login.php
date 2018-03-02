<?php

Route::any('qq',['uses'=>'SocialLogin\LoginController@qq']);
Route::any('qqlogin',['uses'=>'SocialLogin\LoginController@qqlogin']);