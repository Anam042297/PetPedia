<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Breed;
use App\Models\Catagory;
use DataTables;

class BreedController extends Controller
{
    public function index(Request $request){

    if ($request->ajax()) {
        $data = Breed::latest()->get();
        return Datatables::of($data)
                ->addColumn('action', function($row){
                    $editUrl = route('breed.edit', $row->id);
                    $deleteUrl = route('breed.destroy', $row->id);
                    $buttons = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>';
                    $buttons .= ' <form action="' . $deleteUrl . '" method="POST" style="display: inline;">';
                    $buttons .= csrf_field();
                    $buttons .= method_field('DELETE');
                    $buttons .= '<button type="submit" class="btn btn-sm btn-danger">Delete</button></form>';
                    return $buttons;
                })

                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
    return view('dashboard.petbreed.view');
}
public function viewbreed(){
    return view('dashboard.petbreed.view');
}

    public function create(){
        $categories=Catagory::all();
        // dd($categories);
        return view('dashboard.petbreed.create', compact(['categories']));
    }
    public function store(Request $request){
//    dd($request->all());
       // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'catagory_id'=> 'required|string|max:255'
        ]);
        // dd($validatedData);
        // Create a new post instance
        $breed = new  Breed();
        $breed->name = $validatedData['name'];
        $breed->category_id =$validatedData['catagory_id'];
        //  dd($breed);
        $breed->save();


        // Redirect to a success page or route
        return redirect()->route('breed.view');


            }
            public function edit($id)
            {
                $breed = Breed::find($id);
                return view('breed.edit', compact('breed'));
            }
            public function destroy($id)
            {
                $breed = Breed::find($id);

                if (!$breed) {
                    return redirect()->route('breed.view');
                }

                $breed->delete();

                return redirect()->route('breed.view');
            }
}
