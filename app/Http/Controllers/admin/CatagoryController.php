<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatagoryController extends Controller
{
    public function create(){
        return view('dashboard.petcatagory.create');
    }
    public function store(Request $request){
   dd($request->all());
        // Validate incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'catagory_name' => 'required|string|max:255',
        ]);

        // Create a new post instance
        $post = new Post();
        $post->user_id = $validatedData['user_id'];
        $post->pet_name = $validatedData['pet_name'];
        // Save the post
        $post->save();

        // Redirect to a success page or route
        return redirect()->route('Catagory.store');
    }
}
