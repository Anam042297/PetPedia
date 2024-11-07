<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class categoryController extends Controller
{
    // Fetch all categories with images
    public function getAllCategories()
    {

        $categories = Category::all();

        return response()->json([
            'success' => true,
            'data' => $categories

        ]);
    }

    public function getCategorieById($id)
    {
        $data = Category::all()->find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
