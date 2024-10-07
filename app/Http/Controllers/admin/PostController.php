<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use App\Models\User;
use App\Models\Category;
use App\Models\Breed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DataTables;

class PostController extends Controller
{
    // data table
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::with(['category', 'breed', 'images', 'user'])->get();
            return DataTables::of($posts)
                ->addColumn('action', function ($row) {
                    $editUrl = route('post.edit', $row->id);
                    $deleteUrl = route('post.destroy', $row->id);
                    $action = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a> &nbsp'
                        . '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_post_button"> <i class="fas fa-trash-alt"></i></button>';

                    return $action;
                })
                ->addColumn('images', function ($row) {
                    if ($row->images->isEmpty()) {
                        return ''; // Return empty if there are no images
                    }
                    $firstImage = $row->images->first();
                    return '<img src="' . $firstImage->url . '" class="d-block w-100" alt="Image">';
                })

                ->rawColumns(['images', 'action'])
                ->make(true);
        }
        return view('dashboard.post.viewpost');
    }
    //view blade for data table
    public function viewpost()
    {
        return view('dashboard.post.viewpost');
    }
    //create post
    public function create()
    {
        $categories = Category::all();
        $breeds = Breed::all();
        return view('dashboard.post.createpost', compact('categories', 'breeds'));
    }
    //store the created post
    public function store(Request $request)
    {
        // dd($request->all());
        // dd(123);
        // try {
            $validatedData = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'breed_id' => 'required|exists:breeds,id',
                'gender' => 'required|string',
                'name' => 'required|string|max:255',
                'age' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif',
            ]);

            // dd($validatedData); 
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     // dd($e->errors());
        // }
        $user_id = Auth::id();
        // dd($user_id);
        $post = new Post();
        $post->user_id = $user_id;
        $post->category_id = $validatedData['category_id'];
        $post->breed_id = $validatedData['breed_id'];
        $post->gender = $validatedData['gender'];
        $post->name = $validatedData['name'];
        $post->age = $validatedData['age'];
        $post->description = $validatedData['description'];
        //  dd($post);
        $post->save();
        // dd($request->hasFile('images'));
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
    //get breed info as per catagory
    public function getBreeds($category_id)
    {
        $breeds = Breed::where('category_id', $category_id)->get();
        return response()->json($breeds);
    }

    //edit post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $breeds = Breed::all();
        return view('dashboard.post.createpost', compact('post', 'categories', 'breeds'));
    }
    //update post
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'breed_id' => 'required|exists:breeds,id',
            'gender' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'description' => 'string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($validatedData);
        $post = Post::findOrFail($id);
        $post->category_id = $validatedData['category_id'];
        $post->breed_id = $validatedData['breed_id'];
        $post->gender = $validatedData['gender'];
        $post->name = $validatedData['name'];
        $post->age = $validatedData['age'];
        $post->description = $validatedData['description'];
        // Handle file uploads if any
        if ($request->hasFile('images')) {
            $post->images()->delete();
            // dd($request->images);
            foreach ($request->file('images') as $image) {
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/images', $filename);
                $url = Storage::url($path);
                // dd($url);
                Image::create([
                    'post_id' => $post->id,
                    'url' => $url,
                ]);

            }
        }
        $post->save();

        return redirect()->route('post.index')->with('success', 'Post updated successfully.');

    }
    //delete post
    public function destroy(string $id)
    {
        // dd(123);
        $data = Post::with('images')->findorfail($id);
        // dd($data);
        if (!$data) {
            return response()->json(['error' => 'post not found ".'], 404);
        }
        $data->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }


}
