<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catagory;
use DataTables;

class CatagoryController extends Controller
{public function index(){

    if ($request->ajax()) {
        $data = Catagory::latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('catagory.edit', $row->id);
                    $deleteUrl = route('catagory.destroy', $row->id);
                    $buttons = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>';
                    $buttons .= ' <form action="' . $deleteUrl . '" method="POST" style="display: inline;">';
                    $buttons .= csrf_field();
                    $buttons .= method_field('DELETE');
                    $buttons .= '<button type="submit" class="btn btn-sm btn-danger">Delete</button></form>';
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    return view('dashboard.petcatagory.view');
}
    public function datatable_blade(){
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
        return redirect()->route('Catagory.store');


            }
            public function edit($id)
            {
                $user = User::find($id);
                return view('catagory.edit', compact('user'));
            }
            public function destroy($id)
            {
                $user = User::find($id);

                if (!$user) {
                    return redirect()->route('Catagory.display')->with('error', 'User not found.');
                }

                $user->delete();

                return redirect()->route('Catagory.display')->with('success', 'User deleted successfully.');
            }
    }

