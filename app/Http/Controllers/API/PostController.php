<?php

namespace App\Http\Controllers\API;
use App\Models\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
// Fetch all posts with related data
public function getAllPosts()
{
    $posts = Post::with(['catagory', 'breed', 'images', 'user'])->get();

    return response()->json([
        'success' => true,
        'data' => $posts
    ]);
}

// Fetch a single post by ID
public function getPostById($id)
{
    $post = Post::with(['catagory', 'breed', 'images', 'user'])->find($id);

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

}
