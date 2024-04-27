<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function addBrand(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100|unique:brands',
            'image' => 'required|mimes:jpg,png,bmp',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed..!',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        $brand = new Brand;
        $brand->name = $request->name;

        /*
        This code is used in Laravel to handle file uploads.
        It checks if the request contains an image file,
        and if it does, it generates a unique filename based on the current time
        and the original filename of the uploaded image.
        It then moves the uploaded image to a specified directory (in this case, 'images/Brand').
        */
        if ($request->image) {
            $destination = time().$request->image->getClientOriginalName();
            $request->image->move('images/brands', $destination);
            $brand->image = $destination;
            $brand->image="images/brands/$brand->image";
        }
        $brand->save();
        if ($brand) {
            return response()->json([
                'message' => 'The brand has been added successfully',
                'data' => $brand->makeHidden( ['created_at','updated_at','recovery_code']),
            ], 200);
        } else {
            return response()->json([
                'massage' => 'Something went wrong',
            ], 400);
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    public function getAllBrands()
    {
        $brands = Brand::all(
            'id',
            'name',
            'image'
        );

        if(count($brands)==0){
            return response()->json([
                'message' => 'There are no brands to show it',
            ], 200);
        }
        else{
        return response()->json([
            'message' => 'These are all the Brand we have',
            'data' => $brands,
        ], 200);
         }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    public function addCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed..!',
                'errors' => $validator->errors()->all(),
            ], 422);
        }
        $category = new Category;
        $category->name = $request->name;
        $category->save();

        if ($category) {
            return response()->json([
                'message' => 'The Catgory has been added successfully',
                'data' => $category,
            ], 200);
        } else {
            return response()->json([
                'massage' => 'Something went wrong',
            ], 400);
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    public function getAllCategories()
    {
        $category = Category::all(
            'id',
            'name'
        );

        if(count($category)==0){
            return response()->json([
                'message' => 'There are no categorys to show it',
            ], 200);
        }

        else{
        return response()->json([
            'message' => 'These are all the Categorys we have',
            'data' => $category,
        ], 200);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////
    public function addSubcategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed..!',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        $subcategory = Subcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
        ]);

        if ($subcategory) {
            return response()->json([
                'message' => 'The Subcatgory has been added successfully',
                'data' => $subcategory,
            ], 200);
        } else {
            return response()->json([
                'massage' => 'Something went wrong',
            ], 400);
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    public function getSubcategory($category_id)
    {
        $subcategory = Category::find($category_id);
        if ($subcategory) {
            return response()->json([
                'message' => 'Success',
                'data' => $subcategory->get_sub_Cate->makeHidden( ['created_at','updated_at']),
            ], 200);
        } else {
            return response()->json([
                'message' => 'There is no subcategory with this id',
            ], 402);
        }
    }
}
/* In Laravel, `$brand = new Brand` creates a new instance of the `Brand` model. This means that `$brand` is now an object
 that represents a single record in the `brands` table of your database.
 You can use this object to interact with the database
 and perform CRUD (Create, Read, Update, Delete) operations on the `brands` table.
 For example, you could use `$brand->name = 'Nike'` to set the name of the brand to "Nike", and then `$brand->save()` to save this change to the database.
*/
