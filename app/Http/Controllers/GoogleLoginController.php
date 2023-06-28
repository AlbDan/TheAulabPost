<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        $googleUser = Socialite::driver('google')->stateless()->user();
        $findUser = User::where('google_id', $googleUser->id)->first();
        if ($findUser) {
            Auth::login($findUser);
            return redirect(route('homepage'));
        } else {
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => encrypt('')
            ]);

            Detail::create([
                'realname' => $googleUser->user['given_name'],
                'surname' => $googleUser->user['family_name'],
                'city' => 'indefinita',
                'user_id'=> $newUser->id
            ]);

            Auth::login($newUser);
            return redirect(route('homepage'));
        }
    }
}
