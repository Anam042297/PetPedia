<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiUserController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\categoryController;
use App\Http\Controllers\API\breedController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\frontend\OrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register',[ApiUserController::class,'register']);
Route::post('/login',[ApiUserController::class,'login']);
//view user
Route::get('/user/{id}', [ApiUserController::class, 'getUserById']);
//home page post
Route::get('showpost',[PostController::class,'getAllPosts']);
//single post page
Route::get('showpost/{id}',[PostController::class,'getPostById']);
//all post related to category
Route::get('/showpost/category/{id}', [PostController::class, 'getPostsByCategory']);
//all post related to breed
Route::get('/showpost/breed/{id}', [PostController::class, 'getPostsByBreed']);
Route::get('/categories/{categoryId}/breeds', [breedController::class, 'getBreedsByCategory']);
Route::get('/breeds/{breedId}/posts', [breedController::class, 'getPostsByBreed']);


















//ome page category
Route::get('categories', [categoryController::class, 'getAllCategories']);
Route::get('categories/{id}', [categoryController::class, 'getCategorieById']);


Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::get('/product/{id}',[ProductController::class,'getProductById']);
Route::get('productcategory', [ProductCategoryController::class, 'getAllCategories']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart/add', [CartController::class, 'addToCart']);
    Route::put('cart/update/{id}', [CartController::class, 'updateCartItem']);
    Route::delete('cart/remove/{id}', [CartController::class, 'removeFromCart']);
    Route::delete('cart/clear', [CartController::class, 'clearCart']);

    Route::get('/orders', [OrderController::class, 'index']); // Get user's orders
    Route::post('/checkout', [OrderController::class, 'checkout']); // Checkout process
    Route::get('/checkout-form', [OrderController::class, 'checkoutForm']); // Get checkout form data
    Route::get('/order/success/{order}', [OrderController::class, 'success']); // Order success
});
