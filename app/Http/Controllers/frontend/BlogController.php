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
        $threads = Thread::with(['user', 'posts.replies.user', 'posts.reactions'])->latest()->paginate(10);
        return view('frontend.blog', compact('posts','threads'));
    }
    public function show($id){
        $post = Post::with(['catagory', 'breed', 'images'])->findOrFail($id);
        return view('frontend.singleblog', compact('post'));
    }
}
