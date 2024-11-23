<?php

namespace App\Http\Controllers\UserSide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use App\Models\Category;
class UserProductController extends Controller
{
    public function getProductsByCategory($categoryId)
{
    $category = Category::findOrFail($categoryId); 
    $products = Product::where('category_id', $categoryId)
                        ->where('stock', '>=', 1)
                        ->with('productImages');
    return view('userside.category_products', compact('products', 'category'));
}

    public function getProductsByProductCategory($productcategoryId)
    {
        $products = Product::where('product_category_id', $productcategoryId)
        ->where('stock','>=',1)
        ->with('productImages')->get();
        $productCategory = ProductCategory::findOrFail($productcategoryId);
        return view('userside.productcategory_products', compact('products', 'productCategory'));
    }
    
}
