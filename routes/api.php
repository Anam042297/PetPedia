<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\PostController;

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

Route::get('posts', [PostController::class, 'index']);            // Get all posts
Route::post('posts', [PostController::class, 'store']);           // Create a new post
Route::get('posts/{id}', [PostController::class, 'show']);        // Get a specific post
Route::put('posts/{id}', [PostController::class, 'update']);      // Update a specific post
Route::delete('posts/{id}', [PostController::class, 'destroy']);  // Delete a specific post

Route::get('categories/{category_id}/breeds', [PostController::class, 'getBreeds']);  // Get breeds by category
