<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use App\Models\User;
use App\Models\Catagory;
use App\Models\Breed;

class PostController extends Controller
{
    public function create(){
        $categories = Catagory::all();
        $breeds = Breed::all();
        return view('dashboard.post.createpost',['categories' => $categories,
                                                'breeds' => $breeds]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'catagory_id' => 'exists:catagories,id',
            'breed_id' => 'exists:breeds,id',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image file
        ]);

        // Create a new post instance
        $post = new Post();
        $post->name = $request->name;
        $post->age = $request->age;
        $post->description = $request->description;
        $post->catagory_id = $request->catagory_id;
        $post->breed_id = $request->breed_id;
        $post->user_id = Auth::id(); // Assuming authenticated user

        // Save the post
        $post->save();

        // Handle uploading and associating images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
               $filename = time() . '.' . $image->getClientOriginalExtension();
               $path = $image->storeAs('public/images', $filename);
               $url = Storage::url($path);
               Image::create(['url' => $url,
              'post_id' => $post->id,
           ]);

            }
        }

        // Redirect to a success page or route
        return redirect()->route('posts.store');
    }
}
