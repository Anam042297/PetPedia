<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catagory;
class categoryController extends Controller
{
   // Fetch all categories with images
   public function getAllCategories()
   {

       $categories = Catagory::all();

       return response()->json([
           'success' => true,
           'data' => $categories
       ]);
   }

}
