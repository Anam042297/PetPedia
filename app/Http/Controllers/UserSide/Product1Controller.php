<?php

namespace App\Http\Controllers\UserSide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use App\Models\Category;

class Product1Controller extends Controller
{  
    public function getProductsByCategory($categoryId)
{
    $products = Product::where('category_id', $categoryId)->with('productImages')->get();
    $category = Category::findOrFail($categoryId); 

    return view('userside.category_products', compact('products', 'category'));
}
// In the Controller
public function showCategories()
{
    $categories = Category::all();
    $productCategories = ProductCategory::all();

    return view('your.view', compact('categories', 'productCategories'));
}


 
}
