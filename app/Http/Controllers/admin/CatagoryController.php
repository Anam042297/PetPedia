<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CatagoryController extends Controller
{
    // data table
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editUrl = route('Category.edit', $row->id);
                    $deleteUrl = route('Category.destroy', $row->id);
                    $action = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a> &nbsp'
                        . '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_button"> <i class="fas fa-trash-alt"></i></button>';

                    return $action;
                })


                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['images', 'action'])
                ->make(true);
        }
        return view('dashboard.petcategory.view');
    }
    //view data table view blade
    public function viewcategory()
    {
        return view('dashboard.petcategory.view');
    }
    // create catagory
    public function create()
    {
        return view('dashboard.petcategory.create')->with('success', 'Category created successfully.');
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
        $category = new Category();
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
        return redirect()->route('Category.display');
    }

    // edit view catagory data
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.petcategory.create', compact('category'));
    }


    //  store edit catagory
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $category = Category::findOrFail($id);
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

        return redirect()->route('Category.display')->with('success', 'Category updated successfully.');
    }
    //delete catagory
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['error' => 'user not found ".'], 404);
        }
        $category->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}

