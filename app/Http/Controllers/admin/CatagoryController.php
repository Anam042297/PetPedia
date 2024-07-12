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

        // dd($request->all(), $request->file('images'));
        // dd($request->ajax());
        // if ($request->ajax()) {
        //     // Validate the request inputs
        //     $validator = Validator::make($request->all(), [
        //         'name' => 'required|string|max:255',
        //     ]);
        //     // dd($validator);
        //     if ($validator->fails()) {
        //         return response()->json(['errors' => $validator->errors()], 422);
        //     }
        //     // dd($request->transmission);
        //     // Create car entry
        //     try {
        //         $car = Catagory::create([
        //             'title' => $request->title,
        //             ]);
        //         // dd($car);
        //     } catch (\Exception $e) {
        //         throw $e;
        //         return response()->json(['error' => 'Error creating car: ' . $e->getMessage()], 500);
            }

    }

