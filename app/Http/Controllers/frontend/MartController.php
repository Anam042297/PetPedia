<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PetProduct;
use App\Models\PetCategory;



class MartController extends Controller
{

    public function index(){
       
           // Fetch all products with their images and categories
      $products = PetProduct::with('images', 'category')->get();
      $categories = PetCategory::all();
      // Pass products to the frontend view
      return view('frontend.includes.Mart.index', compact('products'));
    }
    public function show($id)
{
    $product = PetProduct::with('images', 'category')->findOrFail($id);
    return view('frontend.includes.Mart.show', compact('product'));
}
  
}

