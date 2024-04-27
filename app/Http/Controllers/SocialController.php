<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        // return Socialite::driver('google')->redirect();
        return Socialite::with('google')->stateless()->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('social_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return response()->json(
                    $finduser
                );
            } else {
                $newUser = User::create([
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make('my_google'),
                    'recovery_code' => mt_rand(5000, 500000),
                    'social_id' => $user->id,
                    'social_type' => 'google'

                ]);
                Auth::login($newUser);
                return response()->json($finduser);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
