<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catagory;

class CatagoryController extends Controller
{
    public function create(){
        return view('dashboard.petcatagory.create');
    }
    public function store(Request $request){
//    dd($request->all());
       // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new post instance
        $post = new  Catagory();
        $post->name = $validatedData['name'];
        //  dd($post);
        $post->save();


        // Redirect to a success page or route
        return redirect()->route('Catagory.store');


            }

    }

