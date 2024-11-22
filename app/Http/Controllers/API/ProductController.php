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
    $products = Product::with(['category', 'ProductCategory', 'productImages', 'user'])->get()->map(function ($product) {
        return [
            'id' => $product->id,
            'category' => $product->category->name,
            'product_category' => $product->ProductCategory->name,
            'name' => $product->name,
            'price' => $product->price,
            'brand' => $product->brand,
            'weight' => $product->weight,
            'stock' => $product->stock,
            'images' => $product->productImages->pluck('image_path'),
        ];
    });

    return response()->json([
        'success' => true,
        'data' => $products
    ]);
}

    public function getProductById($id)
{
    $product = Product::with(['user', 'category', 'productCategory', 'productImages'])->find($id);

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
}
