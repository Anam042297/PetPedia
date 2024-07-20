<?php

namespace App\Http\Controllers\admin;

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

            'catagory_id' => 'required|exists:catagories,id',
            'breed_id' => 'required|exists:breeds,id',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image file
        ]);
        $user_id = Auth::id();
        // dd($user_id);

        // Create a new post instance
        $post = new Post();
        $post->user_id =$user_id;
        $post->catagory_id = $validatedData['catagory_id'];
        $post->breed_id = $validatedData['breed_id'];
        $post->name = $validatedData['name'];
        $post->age = $validatedData['age'];
        $post->description = $validatedData['description'];
        //  dd($post);
        $post->save();
// dd($request->hasFile('images'));
        // Handle uploading and associating images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
               $filename = time() . '.' . $image->getClientOriginalExtension();
               $path = $image->storeAs('public/images', $filename);
               $url = Storage::url($path);
               Image::create([
              'post_id' => $post->id,
              'url' => $url,
           ]);

            }
        }

        // Redirect to a success page or route
        return redirect('/createpost')->with('success', 'Post created successfully!');
    }
}
