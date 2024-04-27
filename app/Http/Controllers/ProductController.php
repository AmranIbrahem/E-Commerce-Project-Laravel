<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'brand_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required',
            'main_image' => 'required|mimes:jpg,png,bmp',
            'price' => 'required',
            'details' => 'required',
            'quantity' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed..!',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        $category_id = Category::find($request->category_id);
        $brand_id = Brand::find($request->brand_id);
        $sub_category_id = Subcategory::find($request->sub_category_id);
        if ($brand_id) {
            if ($category_id) {
                if ($sub_category_id) {
                    $product = Product::create([
                        'category_id' => $request->category_id,
                        'sub_category_id' => $request->sub_category_id,
                        'brand_id' => $request->brand_id,
                        'name' => $request->name,
                        'price' => $request->price,
                        'details' => $request->details,
                        'quantity' => $request->quantity,
                        'main_image' => $request->main_image,
                        'status' => $request->status,
                    ]);
                    if ($request->main_image) {
                        $destination = time() . $request->main_image->getClientOriginalName();
                        $request->main_image->move('images/products', $destination);
                        $product->main_image = $destination;
                        $product->main_image = "images/products/$product->main_image";

                    }
                    $result = $product->save();
                    if ($result) {
                        return response()->json([
                            'message' => 'Product has been added successfully',
                            'data' => $product->makeHidden( ['created_at','updated_at']),
                        ], 200);
                    } else {
                        return response()->json([
                            'massage' => 'Something went wrong!',
                        ], 400);
                    }
                } else {
                    return response()->json([
                        "message" => "Sub_Category is not found"
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'Category not find!',
                ]);
            }
        } else {
            return response()->json([
                'massage' => 'Brand not found!',
            ], 400);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getAllProducts()
    {
        $product = Product::all();

        if (count($product) != 0){
        return response()->json([
            'message' => 'These are all the products in the store',
            'data' => $product->makeHidden( ['created_at','updated_at']),
        ], 200);
        }
        else{
            return response()->json([
                'message' => 'There are currently no products in store',
            ], 200);
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function addProductImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'image' => 'required|mimes:jpg,png,bmp',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed..!',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        $product = Product::find($request->product_id);
        if ($product) {
            $image = new Image;
            $image->product_id = $request->product_id;

            if ($request->image) {
                $destination = time() . $request->image->getClientOriginalName();
                $request->image->move('images/products', $destination);
                $image->image = $destination;
                $image->image="images/products/$image->image";
            }
            $result = $image->save();

            if ($result) {
                return response()->json([
                    'message' => 'Image has been added successfully.',
                    'data' => $image,
                ], 200);
            } else {
                return response()->json([
                    'massage' => 'Something went wrong!',
                ], 400);
            }
        } else {
            return response()->json([
                'massage' => 'Product ID not Found!',
            ], 400);
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function deleteProduct($product_id)
    {
        $product = Product::find($product_id);

        if ($product) {
            $result = $product->delete();

            if ($result) {
                return response()->json([
                    'message' => 'Product deleted successfully.',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Something went wrong..!',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Product not found..!',
            ], 404);
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function deleteProductImage($image_id)
    {
        $productImage = Image::find($image_id);

        if ($productImage) {
            $result = $productImage->delete();

            //
            // Delete Image from public folder
            //

            if ($result) {
                return response()->json([
                    'message' => 'Image deleted successfully.',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Something went wrong..!',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Image not found..!',
            ], 404);
        }
    }

    ///////////////////////////////////////////////////////////////////
    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'min_price' => 'required',
            'max_price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed..!',
                'errors' => $validator->errors()->all(),
            ], 422);
        }
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 1000);
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

