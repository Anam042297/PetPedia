<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
class ProductCategoryController extends Controller
{
    public function getAllProductCategories()
   {

       $categories = ProductCategory::all();

       return response()->json([
           'success' => true,
           'data' => $categories
           
       ]);
   }
   public function getProductCategoryById($id)
   {
       $categories = ProductCategory::all()->find($id);
   
       if (!$categories) {
           return response()->json([
               'success' => false,
               'message' => 'ProductCategory not found'
           ], 404);
       }
   
       return response()->json([
           'success' => true,
           'data' => $categories
       ]);
   }
}
