<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Cart;
use App\Models\User;
class SaleController extends Controller
{
    public function store(Request $request)
    {
        $userCart = Cart::where('user_id',$request->user_id)->first();

        if ($userCart) {
            $carts = Cart::where('user_id', $request->user_id)->with('product')->get();
            $totalPrice = $carts->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            $user = User::find($request->user_id);
            if ($user->Balance > 0 && $user->Balance >= $totalPrice) {
                $user->Balance -= $totalPrice;
                $user->save();
                $carts = Cart::where('user_id', $request->user_id)->get();
                foreach ($carts as $value){
                    $sale=Sale::create([
                        'product_id' => $value->product_id,
                        'amount' => $value->quantity,
                        'date' =>now() ,
                        'user_id'=>$value->user_id]);
                }
                $carts = Cart::where('user_id', $request->user_id);
                $carts->delete();

                return response()->json([
                    'message' => 'تمت عملية الشراء بنجاح',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'ليس لديك رصيد كافي'
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'لم يتم العثور على معرف المستخدم في السلة'
            ], 401);
        }
    }
//////////////////////////////////////////////////
    public function getMonthlySales(Request $request)
    {
        $monthlySales = Sale::selectRaw("DATE_FORMAT(date, '%Y-%m') as month, SUM(amount) as total_sales")
            ->groupBy('month')
            ->get();

        if(count($monthlySales)>0){
            return response()->json(
                $monthlySales
                , 200);
        }else{
            return response()->json([
                'message' => 'No thing To show'
            ], 401);
        }
    }

//////////////////////////////////////////////////
    public function getYearlySales(Request $request)
    {
        $yearlySales = Sale::selectRaw('YEAR(date) as year, SUM(amount) as total_sales')
            ->groupBy('year')
            ->get();

        if(count($yearlySales)>0){
            return response()->json(
                $yearlySales
                , 200);
        }else{
            return response()->json([
                'message' => 'No thing To show'
            ], 401);
        }
    }

//////////////////////////////////////////////////
    public function getTopSellingProducts(Request $request)
    {
        $topSellingProducts = Sale::select('product_id', Sale::raw('COUNT(*) as total_sales'))
            ->groupBy('product_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(10)
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->get(['products.id','total_sales']);

        $productDetails = [];

        foreach ($topSellingProducts as $product) {
            $productData = Product::select('id', 'name', 'main_image')
                ->find($product->product_id);
            $productData->total_sales = $product->total_sales;
            $productDetails[] = $productData;
        }

        if(count($productDetails)>0){
            return response()->json(
                $productDetails
            , 200);
        }else{
            return response()->json([
                'message' => 'No thing To show'
            ], 401);
        }
    }

//////////////////////////////////////////////////
    public function getMostUserSold(Request $request)
    {
        $mostSoldProducts = Sale::select('user_id', Sale::raw('COUNT(*) as total_sales'))
            ->groupBy('user_id')
            ->orderByRaw('COUNT(*) DESC')
            ->take(2)
            ->get();
        $UserDetails = [];

        foreach ($mostSoldProducts as $user) {
            $UserDetailss = User::select('id', 'full_name')
                ->find($user->user_id);
            $UserDetailss->total_sales = $user->total_sales;
            $UserDetails[] = $UserDetailss;
        }

        if(count($UserDetails)>0){
            return response()->json(
                $UserDetails
                , 200);
        }else{
            return response()->json([
                'message' => 'No thing To show'
            ], 401);
        }
    }
//////////////////////////////////////////////////

}
