<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\product_reviews;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Subcategory;

class ShowProductsController extends Controller
{
    //To get products according to category _id:
    public function showProductsByCategory($id_Category)
    {
        $catgory = Category::find($id_Category);
        if ($catgory) {
            if (count($catgory->productt) != 0){
            return response()->json([
                'message' => 'There are all products in this category',
                'products'=>$catgory->productt->makeHidden( ['created_at','updated_at'])
            ], 200);
            }
            else{
                return response()->json([
                    'message' => 'There are no products in this category',
                ], 402);
            }
        } else {
            return response()->json([
                'message' => 'Catgory not found..!',
            ], 402);
        }
    }

    ///////////////////////////////////////////////////////////////////

    public function showProductOnly($product_id)
    {
        $product = Product::find($product_id);


        if ($product) {
            return response()->json([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_details' => $product->details,
                'product_quantity' => $product->quantity,
                'product_status' => $product->status,
                'images' => $product->main_image,
                'Rating' => $product->average_rating,

            ], 200);
        } else {
            return response()->json([
                'message' => 'Product ID  not found..!',
            ], 402);
        }
    }

    //////////////////////////////////////////////////////////////////////////

    public function showProductBrand($brand_id)
    {
        $brand = Brand::find($brand_id);
        if ($brand) {
            $product = Product::where('brand_id', $brand_id)->get();
            if (count($product) != 0) {
                return response()->json([
                    'message'=>"These are all $brand->name products",
                    'Products' => $product->makeHidden( ['status','average_rating','quantity','details','created_at','updated_at']),
                ], 200);
            } else {
                return response()->json([
                    'message' => "Currently there is no product available at $brand->name",
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'ID Brand Not Found',
            ], 402);
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////

    public function showLast10Product()
    {
        $product = Product::latest()->take(10)->get();

        if ($product) {
            return response()->json([
                'products' => $product->makeHidden( ['sub_category_id','brand_id','category_id','status','average_rating',      'quantity','details','created_at','updated_at']),
            ], 200);
        } else {
            return response()->json([
                'message' => 'An error occurred',
            ], 401);
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////
    public function showProductAccordingToSubcategory($subcategory_id)
    {
        $subcategory = Subcategory::find($subcategory_id);
        if($subcategory){
            $id_sub_prod = $subcategory->show_pro_acc_sub_cate;
            if (count($id_sub_prod) !=0 ) {
                return response()->json([
                    'message' => "These are the products in the $subcategory->name category",
                    'products' => $id_sub_prod,
                ],200);
            }
            else{
                return response()->json([
                    'message' => "There are currently no products in the $subcategory->name category",
                ],200);
            }
        }
        else{
            return response()->json([
                'message' => 'Sub category Not Found',
            ],404);
        }
    }


    /////////////////////////////////////////////////////////////////////////////////////////////

    public function show_product_By_review()
    {

       $products = Product::orderByDesc('average_rating')->take(10)->get();
       $new_products = array();
       foreach ($products as $product) {
           $new_products[] = array(
               'id' => $product->id,
               'name' => $product->name,
               'price' => $product->price,
               'main_image' => $product->main_image,
               'rating' => $product->average_rating,
           );
       }

       return response()->json([
        'Products' => $new_products
       ],200);
    }

}
