<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Thread;

class BlogController extends Controller
{

    public function index(){
        $posts = Post::with(['catagory', 'breed', 'images'])->get();
        return view('frontend.blog', compact('posts'));
    }
    public function show($id){
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $post = Post::with(['catagory', 'breed', 'images'])->findOrFail($id);
        return view('frontend.singleblog', compact('post'));
    }
}
