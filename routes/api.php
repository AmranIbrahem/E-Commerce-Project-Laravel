<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowProductsController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AddRatingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*********************** APIs for Admin Panel (Dashboard) ***********************/
//login Admin
Route::post('/loginAdmin', [AdminAuthController::class, 'loginAdmin']);

Route::group(['middleware' => 'owner'], function () {
    //Add Admin
    Route::post('/AddAnotherAdmin',[OwnerController::class,'AddAnotherAdmin']);

    //Delete Admin
    Route::delete('/DeleteAdmin/{email}',[OwnerController::class,'DeleteAdmin']);

    //Show All Admin
    Route::get('/ShowAdmins',[OwnerController::class,'ShowAllAdmins']);

    //Get Monthly Sales
    Route::get('getMonthlySales', [SaleController::class, 'getMonthlySales']);

    //Get Yearly Sales
    Route::get('getYearlySales', [SaleController::class, 'getYearlySales']);

    //Get TopSelling Products
    Route::get('getTopSellingProducts', [SaleController::class, 'getTopSellingProducts']);

    //Get Most User Sold
    Route::get('getMostUserSold', [SaleController::class, 'getMostUserSold']);

});

Route::group(['middleware' => 'admin'], function () {
    // Add Brand
    Route::post('/add-brand', [BrandController::class, 'addBrand']);

    // Show all Brands
    Route::get('/get-all-brands', [BrandController::class, 'getAllBrands']);

    // Add Catgory
    Route::post('/add-category', [BrandController::class, 'addCategory']);
    // Show all Catgories
    Route::get('/get-all-categories', [BrandController::class, 'getAllCategories']);

    // Add Subcategory
    Route::post('/add-subcategory', [BrandController::class, 'addSubcategory']);
    // Get Subcategory according to category_id
    Route::get('/get-subcatgory/{category_id}', [BrandController::class, 'getSubcategory']);

    // Product CRUD APIs
    Route::post('/add-product', [ProductController::class, 'addProduct']);
    Route::post('/add-product-image', [ProductController::class, 'addProductImage']);
    Route::get('/get-all-products', [ProductController::class, 'getAllProducts']);
    Route::delete( '/delete-product/{product_id}', [ProductController::class, 'deleteProduct']);
    Route::delete('/delete-product-image/{image_id}', [ProductController::class, 'deleteProductImage']);
});

/*********************** Authentication APIs ***********************/
// Basic Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/update-password/{id}', [AuthController::class, 'updatePassword']);
Route::post('/EmailVerified/{id}', [AuthController::class, 'EmailVerified']);
Route::post('/CheckCodePassword/{id}', [AuthController::class, 'CheckCodePassword']);

// Google Auth
Route::get('auth/google/', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

/////////////////////////////////////////////////////////////////////////////////////////////////
Route::group(['middleware' => ['jwt.auth','verified']], function () {

    //Add Balance
    Route::post('/AddBalance',[UserController::class,'AddBalance']);

    //Get Profile
    Route::get('/profile/{id}', [AuthController::class, 'profile']);

    // Search By Product:
    Route::get('/search-by-product-name/{name}', [SearchController::class, 'searchByProductName']);

    // Search By Details:
    Route::get('/search-by-details/{name}', [SearchController::class, 'searchByDetails']);

    //filter:
    Route::get('/filter/{minPrice}/{maxPrice}', [SearchController::class, 'filter']);

    // Show Products by Category:
    Route::get('/show-products/{id}', [ShowProductsController::class, 'ShowProductsByCategory']);

    // Show Products only:
    Route::get('/show-product-only/{id}', [ShowProductsController::class, 'showProductOnly']);

    // Show Products by Brand
    Route::get('/show-product-brand/{id}', [ShowProductsController::class, 'showProductBrand']);

    // Show Products New:
    Route::get('/show-last10-product', [ShowProductsController::class, 'showLast10Product']);

    // Show products according to subcategory_id:
    Route::get('/show-product-subcategory/{subcategory_id}', [
        ShowProductsController::class, 'showProductAccordingToSubcategory'
    ]);

    // Show products By Review:
    Route::get('/show_product_By_review', [ShowProductsController::class, 'show_product_By_review']);

    // Get all subcategory according to category_id:
    //Route::get('/get-subcatgory/{category_id}', [BrandController::class, 'getSubcategory']);

    // Add To Favorite:
    Route::post('/favorite', [UserController::class, 'favorite']);

    // Show The user Favorite:
    Route::get('/get-favorite/{id}', [UserController::class, 'getFavorite']);

    // Delete from Favorite:
    Route::post('/delete-favorite', [UserController::class, 'deleteFavorite']);

    // Add To Follow:
    Route::post('/follow', [UserController::class, 'follow']);

    // Show The user Follow:
    Route::get('/get-follow/{id}', [UserController::class, 'getFollow']);

    // Unfollow:
    Route::post('/unfollow', [UserController::class, 'unfollow']);

    //Add Product To Cart:
    Route::post('/Add_product_to_cart/{id}', [CartController::class, 'Add_product_to_cart']);

    //Show Cart:
    Route::get('/Show_Cart/{id}', [CartController::class, 'show_Cart']);

    //Remove Product from Cart:
    Route::post('/remove_Product_From_Cart/{id}', [CartController::class, 'remove_Product_From_Cart']);

    //Add a review to product:
    Route::post('/add_review/{id}', [AddRatingController::class, 'addReview']);

    //Show product review:
    Route::get('/show_review/{id}', [AddRatingController::class, 'show_review']);

    //Check Cart
    Route::get('/CheckCart/{id}', [CartController::class, 'CheckCart']);

    Route::post('sales', [SaleController::class, 'store']);

});





