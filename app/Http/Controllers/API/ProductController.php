<?php

namespace App\Http\Controllers\Api;


use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProducts()
    {
        // Fetch all products with related models like category, images, and user
        $products = Product::with(['user','category','productCategory', 'productImages'])->get();
    
        // Return a JSON response
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }
    
    
}
