<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SearchController extends Controller
{
    public function searchByProductName($name)
    {
        $product = Product::where("name", "like", "%" . $name . "%")->get([
            'id',
            'name',
            'price',
            'main_image',
            'details',
            'status'
        ]);

        if (count($product) >= 1 ) {
            return response()->json([
                "message" => "Search products by name successully.",
                "data" => $product
            ], 200);
        } else {
            return response()->json([
                "message" => "There is no product with this name"
            ], 404);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function searchByDetails($details)
    {
        $product = Product::where("details", "like", "%" . $details . "%")->get([
            'id',
            'name',
            'price',
            'main_image',
            'details',
            'status'
        ]);

        if (count($product) >=1 ) {
            return response()->json([
                "message" => "Search products by details successully.",
                "data" => $product
            ], 200);
        } else {
            return response()->json([
                "message" => "There is no product with these details"
            ], 404);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function filter($minPrice,$maxPrice)
    {
        $products = Product::whereBetween('price', [$minPrice, $maxPrice])->get();
        if(count($products)==0  ){
            return response()->json([
                'message' => "There are no products within these limits",
            ], 401);
        }
        else{
            return response()->json([
                'products' => $products->makeHidden( ['created_at','updated_at']),
            ], 200);
        }
    }

}
