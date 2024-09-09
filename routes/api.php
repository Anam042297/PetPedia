<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiUserController;
use App\Http\Controllers\API\PostController;
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

Route::get('showpost',[PostController::class,'getAllPosts']);
Route::get('showpost/{id}',[PostController::class,'getPostById']);

Route::get('categories', [categoryController::class, 'getAllCategories']);
