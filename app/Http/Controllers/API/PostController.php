<?php

namespace App\Http\Controllers\API;
use App\Models\Breed;
use App\Models\Post;
use App\Models\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
// Fetch all posts with related data
public function getAllPosts()
{
    $posts = Post::with(['category', 'breed', 'images', 'user'])->get()->map(function ($post) {
        return [
            'category' => $post->category->name,
            'breed' => $post->breed->name,
            'gender' => $post->gender,
            'name' => $post->name,
            'age' => $post->age,
            'description' => $post->description,
            'images' => $post->images->pluck('url'), 
        ];
    });

    return response()->json([
        'success' => true,
        'data' => $posts
    ]);
}

// Fetch a single post by ID
public function getPostById($id)
{
    $post = Post::with(['category', 'breed', 'images', 'user'])->find($id);

    if (!$post) {
        return response()->json([
            'success' => false,
            'message' => 'Post not found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $post
    ]);
}
public function getPostsByCategory($categoryId)
    {
        // Fetch the category by ID
        $category = Category::findOrFail($categoryId);

        // Get all posts related to this category
        $posts = $category->posts()->with('category', 'breed', 'images', 'user')->get();

        // Return posts as JSON response
        return response()->json([
            'category' => $category->name,
            'posts' => $posts
        ], 200);
    }
    public function getPostsByBreed($breedId)
    {
        // Fetch the category by ID
        $breed = Breed::findOrFail($breedId);

        // Get all posts related to this category
        $posts = $breed->posts()->with('category', 'breed', 'images', 'user')->get();

        // Return posts as JSON response
        return response()->json([
            'category' => $breed->name,
            'posts' => $posts
        ], 200);
    }


}
