<?php

namespace App\Http\Controllers\UserSide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Breed;
use App\Models\ProductCategory;

use App\Models\User;
use App\Models\Order;
use App\Models\Cart;
class indexController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('userside.index', compact('categories'));
    }
  

    public function petblog($categoryId)
    {

        $posts = Post::where('category_id', $categoryId)
            ->with(['category', 'breed', 'images'])
            ->paginate(5);
        $categories = Category::withCount('posts')->get();
        $breeds = Breed::where('category_id', $categoryId)
            ->withCount('posts')->get();
        $category = Category::find($categoryId);
        return view(
            'userside.blog',
            compact('posts', 'categories', 'breeds', 'category')
        );
    }
    public function breedBlog($categoryId, $breedId)
    {
        $breeds = Breed::where('category_id', $categoryId)->get();
        $posts = Post::where('category_id', $categoryId)
            ->where('breed_id', $breedId)
            ->with(['category', 'breed', 'images'])
            ->paginate(5);
        return view('userside.breedblog', compact('breeds', 'posts'));
    }
    public function singleBlog($postId)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $post = Post::with(['category', 'breed', 'images'])->findOrFail($postId);
        return view('userside.single-blog', compact('post'));
    }


    public function ViewProfile($id)
    {
        $user = User::findOrFail($id); 
        $CartItemsNo = Cart::where('user_id', $user->id)->count();
        $pendingOrdersNo = Order::where('user_id', $user->id)->where('status', 'pending')->count();// Fetch user by ID
        return view('userside.profile', compact('user', 'CartItemsNo', 'pendingOrdersNo')); 
    }






}
