<?php

namespace App\Http\Controllers;
use App\Http\Requests\Cart\AddProductToCartRequest;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class CartController extends Controller
{
 public function Add_product_to_cart(AddProductToCartRequest $request,$user_id)
 {
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');
    $product = Product::find($productId);
    $user=User::find($user_id);
    if($user) {
        if ($product) {
            if ($product->status == 'available') {
                if ($product->quantity >= $quantity) {
                    $product->quantity -= $quantity;
                    $product->save();

                    $productCary_User = Cart::where('user_id', $user_id)
                        ->where('product_id', $productId)
                        ->first();
                    if ($productCary_User) {
                        $productCary_User->quantity += $quantity;
                        $productCary_User->price += $product->price * $quantity;

                        $productCary_User->save();

                        if ($product->quantity > 0) {
                            $product->status = 'available';
                            $product->save();
                        } else {
                            $product->status = 'unavailable';
                            $product->save();
                        }

                        return response()->json([
                            'message' => " You have already added this product to the cart this quantity will be added to the cart with the previous quantity"
                        ], 200);

                    } else {
                        $cart = Cart::create([
                            'product_id' => $request->product_id,
                            'user_id' => $user_id,
                            'quantity' => $request->quantity,
                            'price' => $product->price * $quantity
                        ]);

                        if ($product->quantity > 0) {
                            $product->status = 'available';
                            $product->save();
                        } else {
                            $product->status = 'unavailable';
                            $product->save();
                        }

                        return response()->json([
                            'message' => " $product->name  has been added to cart successfully."
                        ], 200);
                    }

                } else {
                    return response()->json([
                        'message' => "We do not currently have the required number of products."
                    ], 401);
                }
            } else {
                return response()->json([
                    'message' => "The product is currently out of stock"
                ], 401);
            }
        } else {
            return response()->json([
                'message' => "Error in the ID of the product"
            ], 401);
        }
    }else{
        return response()->json([
            'message' => "Error in the ID of the User"
        ], 401);
    }

 }
/////////////////////////////////////////////////////////////////
    public function show_Cart($user_id)
         {
            $userCart=Cart::where('user_id',$user_id)->first();
            if ($userCart){
                $carts = Cart::where('user_id', $user_id)->with('product')->get();
                $totalPrice = $carts->sum(function ($item) {
                        return $item->quantity * $item->product->price;
                });
             $cart = $carts->makeHidden([
                    'id','product_id','created_at','updated_at','user_id',
             ]);

             $new_cart = array();
             foreach ($cart as $item) {
                $new_item = array(
                        "quantity" => $item["quantity"],
                        "price" => $item["price"],
                        "product_id" => $item["product"]["id"],
                        "product_name" => $item["product"]["name"],
                        "product_main_image" => $item["product"]["main_image"]
                );
                array_push($new_cart, $new_item);
             }


         return response()->json([
                    'cart' => $new_cart ,
                    'total_price' => $totalPrice
         ],200);
        }
        else{
                return response()->json([
                    'message'=>"You haven't shopped anything yet"
                ],200);
        }

     }
 ////////////////////////////////////////////////////////////////////
     public function remove_Product_From_Cart(Request $request,$user_id)
     {
        $check=Product::find($request->product_id);
        if($check){
            $product=Cart::where('product_id', $request->product_id)
                            ->where('user_id', $user_id)->first();
            $name=Product::find($request->product_id)->first();

            if($product){
                $quantity=$product->quantity;

                $oldproduct=Product::find($request->product_id);
                $oldproduct->quantity +=$quantity;
                $oldproduct->save();

                if($oldproduct->status == 'unavailable'){
                    $oldproduct->status='available';
                    $oldproduct->save();

                }
                $product->delete();
                return response()->json(
                    ['message' => "$name->name has been removed from the Cart successfully"
                ],200);
            }
            else{
                return response()->json(
                    ['message' => "There is no product to be deleted"
                    ],401);
            }
        }
        else{
            return response()->json(
              ['message' => "Error in the ID of the product"
              ],401);
       }


     }
    ////////////////////////////////////////////////////////////////////
 public  function CheckCart($user_id){
     $userCart=Cart::where('user_id',$user_id)->first();
     if($user_id){
         $carts = Cart::where('user_id', $user_id)->with('product')->get();
         $totalPrice = $carts->sum(function ($item) {
             return $item->quantity * $item->product->price;
         });
         $user=User::find($user_id);
         if($user->Balance >0 && $user->Balance > $totalPrice ){
         $user->Balance-=$totalPrice;
         $user->save();
         $carts = Cart::where('user_id', $user_id);
         $carts->delete();
         return response()->json([
             'message'=>'the purshicing is done  '
         ],200);}
         else{
             return response()->json([
                 'message'=>'ليس لديك رصيد بما يكف'
             ],401);}


     }else{
         return response()->json([
             'message'=>'user id Not Found'
         ],401);

     }
 }

////////////////////////////////////////////////////////////////////


}
