<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Breed;
use App\Models\Category;
use DataTables;

class BreedController extends Controller
{// data table function
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Breed::latest()->get();
            $data = Breed::with(['category'])->get();
            return Datatables::of($data)
            ->addColumn('category_name', function (Breed $data) {
                return $data->category ? $data->category->name : 'No Category';
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('breed.edit', $row->id);
                $deleteUrl = route('breed.destroy', $row->id);
                $action = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a> &nbsp'
                .  '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_breed_button">  <i class="fas fa-trash-alt"></i></button>';

                return $action;
            })

                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.petbreed.view');
    }
// data table view blade
    public function viewbreed()
    {
        return view('dashboard.petbreed.view');
    }
//create breed
    public function create()
    {
        $categories = Category::all();
        // dd($categories);
        return view('dashboard.petbreed.create', compact(['categories']));
    }
    //store breed
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|string|max:255'
        ]);
        // dd($validatedData);
        // Create a new post instance
        $breed = new Breed();
        $breed->name = $validatedData['name'];
        $breed->category_id = $validatedData['category_id'];
        //  dd($breed);
        $breed->save();


        // Redirect to a success page or route
        return redirect()->route('breed.view');


    }
    // edit  view breed
    public function edit($id)
    {
        $breed = Breed::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.petbreed.create', compact('breed', 'categories'));
    }
    // update breed  data  table
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([

            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $breed = Breed::findOrFail($id);
        $breed->name = $validatedData['name'];
        $breed->category_id = $validatedData['category_id'];

        $breed->save();

        return redirect()->route('breed.view')->with('success', 'Breed updated successfully.');
    }
    // delete breed  data  table
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
