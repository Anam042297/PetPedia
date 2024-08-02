<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Catagory;

class BlogController extends Controller
{

    public function index()
    {
        $posts = Post::with(['catagory', 'breed', 'images'])->get();
        $categories = Catagory::all();
        return view('frontend.blog', compact('posts', 'categories'));

    }
    public function showbycategory($categoryId)
    {

        // Fetch the category
        $category = Catagory::findOrFail($categoryId);

        // Fetch posts related to the category
        $posts = Post::where('catagory_id', $categoryId)->get();

        // Return the view with posts and category data
        return view('frontend.blogcategory', compact('posts', 'category'));


    }

    public function show($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $post = Post::with(['catagory', 'breed', 'images'])->findOrFail($id);
        return view('frontend.singleblog', compact('post'));
    }
}
