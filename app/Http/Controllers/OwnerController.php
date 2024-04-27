<?php

namespace App\Http\Controllers;

use App\Http\Requests\Owner\AddAnotherAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class OwnerController extends Controller
{
    public  function AddAnotherAdmin(AddAnotherAdminRequest $request){
        $check=User::where('email',$request->email)->first();
        if($check){
            if($check->role=='admin'){
                return response()->json([
                    'message' => "$check->full_name is really on the Admin list",
                ], 200);
            }else{
                $check->role='admin';
                $check->save();
                return response()->json([
                    'message' => "$check->full_name has been added to the Admin list successfully",
                ], 200);}
        } else {
            return response()->json([
                'message' => 'The recovery code dose not match ',
            ], 401);
        }
    }
///////////////////////////////////////////////////////////////////////////////
    public  function  DeleteAdmin($email){
        $check=User::where('email',$email)->first();
        if($check){
            if($check->role!='admin'){
                return response()->json([
                    'message' => "$check->full_name is really not on the Admin list",
                ], 200);
            }else{
                $check->role=null;
                $check->save();
                return response()->json([
                    'message' => "$check->full_name was deleted from the Admin list successfully",
                ], 200);
            }
        }else{
            return response()->json([
                'message' => 'The email dose not match ',
            ], 401);
        }
    }
    ///////////////////////////////////////////////////////////////////////////////
    public function ShowAllAdmins(){
        $admins = User::where('role', 'admin')->get();
        $adminCount = User::where('role', 'admin')->count();
        if (count($admins)>0){
            return response()->json([
                'Number Of Admins'=>$adminCount,
                'Admins' => $admins,
            ], 200);
        }else{
            return response()->json([
                'message' => "No Admins to show",
            ], 200);
        }
    }


}
