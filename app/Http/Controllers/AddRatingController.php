<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\product_reviews;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AddRatingController extends Controller
{
 public function addReview(Request $request, $user_id)
 {
    $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric|between:0,5',
            'product_id'=>'required'

    ]);

    if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed..!',
                'errors' => $validator->errors()->all(),
            ], 422);
    }

    $product=Product::find($request->product_id)->first();
    $check = product_reviews::where('user_id', $user_id)
                            ->where('product_id', $request->product_id)
                            ->exists();
    
    if($check){
        return response()->json([
            'message' => "You have already rated $product->name before",
        ], 401);
    }

    else{
        $user = product_reviews::create([
            'user_id' => $user_id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
        ]);
        
        $products=Product::find($request->product_id);
        if($products){
            $averageRating = $products->averageRating();
            if($averageRating ==0) {
                $averageRating=0;   
            }
            else{
                $rounded = round($averageRating, 1); // تقريب الرقم إلى رقمين بعد الفاصلة
                $formatted = number_format($rounded, 1); // تنسيق الرقم بصيغة 'x.x'
                $products->average_rating=$formatted;
                $products->save();
            }
        }

        return response()->json([
            'message' => "Your review has been added successfully",
        ], 200);
    }

 }

 /////////////////////////////////////////////////////////
 
 public function show_review($product_id)
 {
    $check=Product::find($product_id);
    if($check){
        return response()->json([
            'Rating' => $check->average_rating,
        ], 200);       
    }
    else{
        return response()->json([
            'message' => "Product not found",
        ], 401);
    }
 }

 ////////////////////////////////////////////////////////////////////////////




}
