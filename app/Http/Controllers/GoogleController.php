<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Socialite;
use App\User;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        if (Auth::check()) {
            return redirect('/home');
        }

        $oauthUser = Socialite::driver('google')->user();
        $user = User::where('google_id', $oauthUser->id)->first();
        if ($user) {
            Auth::loginUsingId($user->id);
            return redirect('/home');
        } else {
            $newUser = User::create([
                'name' => $oauthUser->name,
                'email' => $oauthUser->email,
                'google_id'=> $oauthUser->id,
                // password tidak akan digunakan ;)
                'password' => md5($oauthUser->token),
                'avatar' => $oauthUser->avatar,
                "role_id" => 1,
                "status" => 0,
                "slug" => \Str::slug($oauthUser->name) . "-" . \Str::random(5)
            ]);
            Auth::login($newUser);
            return redirect('/home');
        }
    }
}
