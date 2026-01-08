<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SocialAuthController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(){
       
        try{
           $googleUser = Socialite::driver('google')->stateless()->user();


            
            $user = user::where('google_id' , $googleUser->id)->first();

            if($user){
                Auth::login($user);
                return redirect()->route('dashboard');

            }
            else{
                $userData = user::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('password@1234'),
                    'google_id' => $googleUser->id,

                ]);

            if($userData){
                Auth::login($userData);
                return redirect()->route('dashboard');
            }
            }
        }
        catch(Exception $e){
            dd($e);
        }
    }
}
