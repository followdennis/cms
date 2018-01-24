<?php

namespace App\Http\Controllers\SocialLogin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    //社会化登录方案
    public function qq(){
        return Socialite::with('qq')->redirect();
    }
    public function qqlogin(){
        $user = Socialite::driver('qq')->user();
        dd($user);
    }
}
