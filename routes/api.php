<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiUserController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\categoryController;
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
Route::post('Register',[ApiUserController::class,'register']);
Route::post('Login',[ApiUserController::class,'login']);
//view user
Route::get('/user/{id}', [ApiUserController::class, 'getUserById']);
//home page post
Route::get('showpost',[PostController::class,'getAllPosts']);
//single post page
Route::get('showpost/{id}',[PostController::class,'getPostById']);
//all post related to category
Route::get('/showpost/category/{id}', [PostController::class, 'getPostsByCategory']);

//ome page category
Route::get('categories', [categoryController::class, 'getAllCategories']);
Route::get('categories/{id}', [categoryController::class, 'getCategorieById']);


Route::get('/products', [ProductController::class, 'getAllProducts']);