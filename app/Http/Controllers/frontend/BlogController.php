<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class BlogController extends Controller
{

    public function index()
    {
        $posts = Post::with(['category', 'breed', 'images'])->get();
        $categories = Category::all();
        return view('frontend.blog', compact('posts', 'categories'));

    }
    public function showbycategory($categoryId)
    {

        // Fetch the category
        $category = Category::findOrFail($categoryId);

        // Fetch posts related to the category
        $posts = Post::where('category_id', $categoryId)->get();

        // Return the view with posts and category data
        return view('frontend.blogcategory', compact('posts', 'category'));


    }

    public function show($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $post = Post::with(['category', 'breed', 'images'])->findOrFail($id);
        return view('frontend.singleblog', compact('post'));
    }
}
