<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class   AdminAuthController extends Controller
{
    public function loginAdmin(LoginRequest $request){
        $user = User::where('email', $request->email)->first();
        $admin = User::where('email', $request->email)->where('role','admin')->first();

        if ($user) {
            $token = JWTAuth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($token) {
                if($admin){
                    return response()->json([
                        'message' => 'Admin login successfully',
                        'data' => $user,
                        'token' => $token,
                    ], 200);
                }            else{
                    return response()->json([
                        'message' => "Sorry you don't have access ",
                    ], 401);
                }

            } else {
                return response()->json([
                    'message' => 'Password does not match.',
                ], 422);
            }

        } else {
            return response()->json([
                'message' => 'The email dose not match ',
            ], 401);
        }
    }

}
