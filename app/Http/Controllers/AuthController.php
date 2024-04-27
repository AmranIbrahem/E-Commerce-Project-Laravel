<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\CheckCodePasswordRequest;
use App\Http\Requests\Auth\EmailVerifiedRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Requests\Auth\updatePasswordRequest;
use App\Mail\EmailVerification;
use App\Mail\PasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $user = User::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'recovery_code' => mt_rand(5000, 5000000),
        ]);
        $token = JWTAuth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        try {
            Mail::to($user->email)->send(new EmailVerification($user->recovery_code,$user->full_name));
        } catch (\Exception $e) {
            $user->delete();
            return response()->json([
                'error' => 'There is a problem sending the email confirmation code or the email does not exist'
            ], 401);
        }

        if ($user) {
                return response()->json([
                    'message' => 'Registration successfully And the confirmation code has been sent to your email',
                    'data' => $user,
                    'token' => $token,
                ], 200);
        } else {
                return response()->json([
                    'message' => 'Registration failed..!',
                ], 401);
        }
    }

     ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function EmailVerified(EmailVerifiedRequest $request,$id){

        $user=User::where('id',$id)->first();
        if($user->email_verified_at==true){
            return response()->json([
                'message' => " The account is already confirmed",
            ], 200);
        }else{
            if($user) {
                $check=User::where('id',$id)->where('recovery_code',$request->recovery_code)->first();
                if($check){
                    $check->email_verified_at = \Carbon\Carbon::now();
                    $check->save();
                    return response()->json([
                        'message' => "The email has been confirmed successfully ",
                    ], 200);
                }else{
                    return response()->json([
                        'message' => "Recovery Code don't macht",
                    ], 401);
                }
            }else{
                return response()->json([
                    'message' => 'ID User Noy Found',
                ], 401);
            }
        }



    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user && $user->email_verified_at != true){
            Mail::to($user->email)->send(new EmailVerification($user->recovery_code,$user->full_name));
            return response()->json([
                'message' => "You can't log in until the email is confirmed So you can send the confirmation code to your email",
            ], 401);
        }else{
            if ($user) {
                $token = JWTAuth::attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ]);

                if ($token) {
                    return response()->json([
                        'message' => 'User login successfully',
                        'data' => $user,
                        'token' => $token,
                    ], 200);
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

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
        ]);

        try {
            // invalidate token
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'success' => true,
                'message' => 'Logout successfully',
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to logout..!',
            ], 500);
        }
    }

     ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->recovery_code=mt_rand(5000, 5000000);
            Mail::to($user->email)->queue(new PasswordEmail ($user->recovery_code,$user->full_name));

            $user->update();
            return response()->json([
                    'message' => 'The confirmation code has been sent to your email',
                    'user_id' => $user->id,
                ], 202);

        } else {
            return response()->json([
                'message' => 'The email dose not match ',
            ], 401);
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////

    public  function CheckCodePassword(CheckCodePasswordRequest $request,$id){

        $user=User::find($id);
        if($user){
            $check=User::where('id',$id)->where('recovery_code',$request->recovery_code)->first();
            if($check){
            return response()->json([
                'message' => 'recovery code match ',
            ], 200);
            }else{
                return response()->json([
                    'message' => 'recovery code dose not match ',
                ], 401);
            }

        }else{
            return response()->json([
                'message' => 'ID User dose not match ',
            ], 401);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updatePassword(updatePasswordRequest $request, $user_id)
    {
        $user = User::find($user_id);

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            $token = auth()->attempt([
                'email' => $user->email,
                'password' => $request->password,
            ]);

            return response()->json([
                'message' => 'User login successfully',
                'data' => $user,
                'token' => $token,
            ], 200);
        } else {
            return response()->json([
                'message' => 'id failed..!',
            ], 422);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function profile($id_user){
        $check=user::find($id_user);
        if($check){
            return response()->json([
                'data'=>$check,
                'recovery code'=>$check->recovery_code
            ],200);
        }else{
            return response()->json([
                'massage'=>"ID User NOT Found"
            ],401);
        }
    }


}

/*
The mt_rand function in Laravel is a built-in PHP function that generates a random integer using the Mersenne Twister algorithm.
It takes two parameters, the minimum and maximum values of the range from which the random number should be generated.
In Laravel, mt_rand can be used in various scenarios such as generating random passwords,
generating unique IDs, and creating randomized data for testing purposes.
*/
