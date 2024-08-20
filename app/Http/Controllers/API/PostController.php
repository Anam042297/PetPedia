<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use App\Models\User;
use App\Models\Catagory;
use App\Models\Breed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Get all posts with related data
    public function index()
    {
        $posts = Post::with(['catagory', 'breed', 'images', 'user'])->get();

        return response()->json($posts, 200);
    }

    // Store a new post
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'catagory_id' => 'required|exists:catagories,id',
            'breed_id' => 'required|exists:breeds,id',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user_id = Auth::id();

        $post = new Post();
        $post->user_id = $user_id;
        $post->catagory_id = $validatedData['catagory_id'];
        $post->breed_id = $validatedData['breed_id'];
        $post->name = $validatedData['name'];
        $post->age = $validatedData['age'];
        $post->description = $validatedData['description'];
        $post->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/images', $filename);
                $url = Storage::url($path);
                Image::create([
                    'post_id' => $post->id,
                    'url' => $url,
                ]);
            }
        }

        return response()->json(['success' => 'Post created successfully!', 'post' => $post], 201);
    }

    // Get breeds by category ID
    public function getBreeds($category_id)
    {
        $breeds = Breed::where('category_id', $category_id)->get();

        return response()->json($breeds, 200);
    }

    // Show a specific post
    public function show($id)
    {
        $post = Post::with(['catagory', 'breed', 'images', 'user'])->findOrFail($id);

        return response()->json($post, 200);
    }

    // Update an existing post
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'catagory_id' => 'required|exists:catagories,id',
            'breed_id' => 'required|exists:breeds,id',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::findOrFail($id);
        $post->catagory_id = $validatedData['catagory_id'];
        $post->breed_id = $validatedData['breed_id'];
        $post->name = $validatedData['name'];
        $post->age = $validatedData['age'];
        $post->description = $validatedData['description'];
        $post->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/images', $filename);
                $url = Storage::url($path);
                Image::create([
                    'post_id' => $post->id,
                    'url' => $url,
                ]);
            }
        }

        return response()->json(['success' => 'Post updated successfully!', 'post' => $post], 200);
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Post::with('images')->findOrFail($id);

        if ($post->images) {
            foreach ($post->images as $image) {
                Storage::delete(str_replace('/storage', 'public', $image->url));
            }
        }

        $post->delete();

        return response()->json(['success' => 'Post deleted successfully.'], 200);
    }
}
