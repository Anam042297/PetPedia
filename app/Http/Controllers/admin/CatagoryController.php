<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catagory;
use DataTables;

class CatagoryController extends Controller
{public function index(Request $request){

    if ($request->ajax()) {
        $data = Catagory::latest()->get();
        return Datatables::of($data)
        ->addColumn('action', function ($row) {
            return '<button class="btn btn-danger btn-sm delete" data-id="'.$row->id.'">Delete</button>';
        })

                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
    return view('dashboard.petcatagory.view');
}
    public function viewcatagory(){
    return view('dashboard.petcatagory.view');
}
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
        return redirect()->route('Catagory.display');


            }
            public function edit($id)
            {
                $catagory = Catagory::find($id);
                return view('catagory.edit', compact('catagory'));
            }
            // public function destroy($id)
            // {
            //     $catagory = Catagory::find($id);

            //     if (!$catagory) {
            //         return redirect()->route('Catagory.display');
            //     }

            //     $catagory->delete();

            //     return redirect()->route('Catagory.display');
            // }
    }

