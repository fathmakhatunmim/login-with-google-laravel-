<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(){
        $googleUser = Socialite::driver('google')->user();
        dd($googleUser);
    }
}
