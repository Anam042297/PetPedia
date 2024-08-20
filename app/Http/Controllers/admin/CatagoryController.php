<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catagory;
use Yajra\DataTables\Facades\DataTables;

class CatagoryController extends Controller
{
    // data table
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Catagory::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editUrl = route('Catagory.edit', $row->id);
                    $deleteUrl = route('Catagory.destroy', $row->id);
                    $action = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a> &nbsp'
                        . '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_button"> <i class="fas fa-trash-alt"></i></button>';

                    return $action;
                })


                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['images', 'action'])
                ->make(true);
        }
        return view('dashboard.petcatagory.view');
    }
    //view data table view blade
    public function viewcatagory()
    {
        return view('dashboard.petcatagory.view');
    }
    // create catagory
    public function create()
    {
        return view('dashboard.petcatagory.create');
    }
    // store catagory data
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Create a new category instance
        $category = new Catagory();
        $category->name = $validatedData['name'];
        $category->save();

        // Check if an image file was uploaded
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images', $filename);
            $url = Storage::url($path);
            $category->image = $url;
            $category->save();
        }

        // Redirect to a success page or route
        return redirect()->route('Catagory.display');
    }

    // edit view catagory data
    public function edit($id)
    {
        $category = Catagory::findOrFail($id);
        return view('dashboard.petcatagory.create', compact('category'));
    }


    //  store edit catagory
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $category = Catagory::findOrFail($id);
        $category->name = $request->input('name');
        // Update other fields as needed
        $category->save();
         // Check if an image file was uploaded
         if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images', $filename);
            $url = Storage::url($path);
            $category->image = $url;
            $category->save();
        }

        return redirect()->route('Catagory.display')->with('success', 'Category updated successfully.');
    }
    //delete catagory
    public function destroy($id)
    {
        $catagory = Catagory::find($id);

        if (!$catagory) {
            return response()->json(['error' => 'user not found ".'], 404);
        }
        $catagory->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}

