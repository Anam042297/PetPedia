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
use DataTables;

class PostController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $posts = Post::with(['catagory', 'breed', 'images', 'user'])->select('posts.*');
        return DataTables::of($posts)
            ->addColumn('action', function ($row) {
                $editUrl = route('post.edit', $row->id);
                // $deleteUrl = route('post.destroy', $row->id);
                return '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>' .
                       ' <button class="btn btn-danger btn-sm delete" data-id="'.$row->id.'">Delete</button>';
            })
            ->addColumn('images', function ($row) {
                $images = '';
                foreach ($row->images as $image) {
                    $images .= '<img src="' . asset('storage/images/' . $image->path) . '" class="img-thumbnail" width="100">';
                }
                return $images;
            })
            ->rawColumns(['images', 'action'])
            ->make(true);
    }
    return view('dashboard.post.viewpost');
}
    public function viewpost(){
        return view('dashboard.post.viewpost');
    }
    public function create(){
        $categories = Catagory::all();
        $breeds = Breed::all();
        return view('dashboard.post.createpost',compact('categories', 'breeds'));
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
        return redirect('/admin/viewpost')->with('success', 'Post created successfully!');
    }
    public function getBreeds($category_id)
{
    $breeds = Breed::where('category_id', $category_id)->get();
    return response()->json($breeds);
}

public function edit($id)
{
    $post = Post::findOrFail($id);
    $categories = Catagory::all();
    $breeds = Breed::all();
    return view('dashboard.post.createpost', compact('post', 'categories', 'breeds'));
}
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
        // Handle file uploads if any
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
        $post->save();

        return redirect()->route('post.index')->with('success', 'Post updated successfully.');
    }
}
