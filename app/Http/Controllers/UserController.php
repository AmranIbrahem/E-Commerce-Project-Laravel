<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserController\AddBalanceRequest;
use App\Http\Requests\UserController\DeleteFavoriteRequest;
use App\Http\Requests\UserController\FavoriteRequest;
use App\Http\Requests\UserController\FollowRequest;
use App\Http\Requests\UserController\UnFollowRequest;
use App\Models\Brand;
use App\Models\Favorite;
use App\Models\Follow;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function favorite(FavoriteRequest $request)
    {
        $user = User::find($request->user_id);
        $product = Product::find($request->product_id);

        $check = Favorite::where('product_id', $request->product_id)
            ->where('user_id', $request->user_id)->exists();

        if ($check) {
            return response()->json([
                'message' => "You have already added $product->name to your favorites before ",
            ], 200);
        } else {

            if ($user && $product) {
                $favorite = Favorite::create([
                    'product_id' => $request->product_id,
                    'user_id' => $user->id,
                ]);
                if ($favorite) {
                    return response()->json([
                        'message' => "$product->name has been added to favorites successfully ",
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Something went wrong!',
                    ], 401);
                }
            } else {
                return response()->json([
                    'message' => 'User ID or product ID not found!',
                ], 401);
            }
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFavorite($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $data = $user->getFavorite;
            if (count($user->getFavorite) >= 1) {
                $sub_arr = [];
                foreach ($data as $value) {
                    array_push($sub_arr, [
                        'product IDs' => $value->product_id,
                    ]);
                }
                $product = Product::find($sub_arr, ['name', 'main_image', 'price']);

                return response()->json([
                    'message'=>"These are all my favorite products",
                    'Product' => $product,
                ], 200);
            } else {
                return response()->json([
                    'message' => "There's no favorite to show.",
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'User not found',
            ], 402);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function deleteFavorite(DeleteFavoriteRequest $request)
    {
        $user = User::find($request->user_id);
        $product = Product::find($request->product_id);

        if ($user && $product) {
            $check = Favorite::where('product_id', $request->product_id)
                ->where('user_id', $request->user_id)
                ->first();

            if ($check) {
                $result = $check->delete();
                if ($result) {
                    return response()->json([
                        'message' => 'Product has been removed from wishlist.',
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Something went wrong..!',
                    ], 404);
                }
            } else {
                return response()->json([
                    'message' => 'Something went wrong..!',
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'User or Product are not found..!',
            ]);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function follow(FollowRequest $request)
    {
        $user = User::find($request->user_id);
        $brand = Brand::find($request->brand_id);

        $check = Follow::where('brand_id', $request->brand_id)
            ->where('user_id', $request->user_id)->exists();
        if ($check) {
            return response()->json([
                'message' => "You already have followed $brand->name..!",
            ], 200);
        } else {
            if ($user && $brand) {
                $follow = Follow::create([
                    'brand_id' => $request->brand_id,
                    'user_id' => $user->id,
                ]);
                if ($follow) {
                    return response()->json([
                        'message' => "You have followed $brand->name",
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Something went wrong..!',
                    ], 401);
                }
            } else {
                return response()->json([
                    'message' => 'ID User OR ID Product Not found..!',
                ], 401);
            }
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFollow($user_id)
    {
        $user = User::find($user_id);

        if ($user) {
            $data = $user->getFollow;
            if (count($user->getFollow) >= 1) {
                $sub_arr = [];
                foreach ($data as $value) {
                    array_push($sub_arr, [
                        'brand ID' => $value->brand_id,
                    ]);
                }
                $brand = Brand::find($sub_arr);

                return response()->json([
                    'message'=>"These are all the companies you follow",
                    'brand' => $brand,
                ], 200);
            } else {
                return response()->json([
                    'message' => "There's no favorite to show..!",
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'User not found..!',
            ], 402);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function unfollow(UnFollowRequest $request)
    {
        $user = User::find($request->user_id);
        $brand = Brand::find($request->brand_id);

        if ($user && $brand) {
            $check = Follow::where('brand_id', $request->brand_id)
                ->where('user_id', $request->user_id)
                ->first();

            if ($check) {
                $result = $check->delete();

                if ($result) {
                    return response()->json([
                        'message' => 'Unfollow is done successfully.',
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Something went wrong..!',
                    ], 404);
                }
            } else {
                return response()->json([
                    'message' => 'Something went wrong..!',
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'User or Brand are not found..!',
            ]);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function  AddBalance(AddBalanceRequest $request){
        $user = User::where('id',$request->user_id)->first();
        if($user){
            $user->Balance+=$request->Balance;
            $user->save();
            return response()->json([
                'message' => 'Add Balance Scucfly',
            ],200);

        }else{
            return response()->json([
                'message' => 'user id is not found..!',
            ],401);
        }

    }

}
