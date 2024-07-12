<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use App\Models\User;

class PostController extends Controller
{
    public function create(){
        return view('dashboard.post.createpost');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'pet_name' => 'required|string|max:255',
            'category_id' => 'exists:categories,id',
            'breed_id' => 'exists:breeds,id',
            'age' => 'required|integer|min:0',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image file
        ]);

        // Create a new post instance
        $post = new Post();
        $post->user_id = $validatedData['user_id'];
        $post->pet_name = $validatedData['pet_name'];
        $post->category_id = $validatedData['category_id'];
        $post->breed_id = $validatedData['breed_id'];
        $post->age = $validatedData['age'];
        $post->description = $validatedData['description'];

        // Save the post
        $post->save();

        // Handle uploading and associating images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images', 'public'); // Store the image file
                // Create a new image record in the database
                $newImage = new Image();
                $newImage->post_id = $post->id; // Assuming post_id is the foreign key for images
                $newImage->path = $imagePath;
                $newImage->save();
            }
        }

        // Redirect to a success page or route
        return redirect()->route('posts.store');
    }
}
