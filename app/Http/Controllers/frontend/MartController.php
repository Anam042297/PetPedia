<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;



class MartController extends Controller
{

    public function index(){
       
           // Fetch all products with their images and categories
      $products = Product::with('productimages', 'productCategory')->get();
      $categories = ProductCategory::all();
      // Pass products to the frontend view
      return view('frontend.Mart.index', compact('categories','products'));
    }
    public function show($id)
{
$product = Product::with('productimages', 'productCategory')->findOrFail($id);
return view('frontend.Mart.show', compact('product'));
}
// public function index(Request $request) {
//   $query = Product::with('product_images', 'productCategory');
  
//   if ($request->has('category_id')) {
//       $query->where('product_category_id', $request->category_id);
//   }
  
//   $product = $query->paginate(10);
//   $categories = ProductCategory::all();

//   return view('frontend.Mart.index', compact('products', 'categories'));
// }

}
  


