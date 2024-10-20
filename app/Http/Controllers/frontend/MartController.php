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
    

}
  


