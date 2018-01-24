<?php

Route::any('qq',['use'=>'SocialLogin/LoginController@qq']);
Route::any('qqlogin',['use'=>'SocialLogin/LoginController@qqlogin']);