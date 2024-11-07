<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
class ProductCategoryController extends Controller
{
    public function getAllCategories()
    {

        $categories = ProductCategory::all();

        return response()->json([
            'success' => true,
            'data' => $categories

        ]);
    }
}
