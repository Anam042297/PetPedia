<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Breed;
use App\Models\Catagory;
use DataTables;

class BreedController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            // $data = Breed::latest()->get();
            $data = Breed::select('breeds.*', 'catagories.name as category_name')
                ->join('catagories', 'breeds.category_id', '=', 'catagories.id');
            return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $editUrl = route('breed.edit', $row->id);
                $deleteUrl = route('breed.destroy', $row->id);
                $action = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>'
                .  '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_breed_button"> Delete</button>';

                return $action;
            })

                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.petbreed.view');
    }

    public function viewbreed()
    {
        return view('dashboard.petbreed.view');
    }

    public function create()
    {
        $categories = Catagory::all();
        // dd($categories);
        return view('dashboard.petbreed.create', compact(['categories']));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'catagory_id' => 'required|string|max:255'
        ]);
        // dd($validatedData);
        // Create a new post instance
        $breed = new Breed();
        $breed->name = $validatedData['name'];
        $breed->category_id = $validatedData['catagory_id'];
        //  dd($breed);
        $breed->save();


        // Redirect to a success page or route
        return redirect()->route('breed.view');


    }
    public function edit($id)
    {
        $breed = Breed::findOrFail($id);
        $categories = Catagory::all();
        return view('dashboard.petbreed.create', compact('breed', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([

            'name' => 'required|string|max:255',
            'catagory_id' => 'required|exists:catagories,id',
        ]);

        $breed = Breed::findOrFail($id);
        $breed->name = $validatedData['name'];
        $breed->category_id = $validatedData['catagory_id'];

        $breed->save();

        return redirect()->route('breed.view')->with('success', 'Breed updated successfully.');
    }
    public function destroy($id)
    {
        // dd(123);
        $breed = Breed::find($id);
        // dd($breed);
        if (!$breed) {
            return response()->json(['error' => 'breed not found ".'], 404);
        }
        $breed->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
