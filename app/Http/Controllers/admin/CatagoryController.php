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
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        $imageUrl = $row->image;
                        return '<img src="' . $imageUrl . '" class="d-block w-100" style="max-width: 80px; max-height: 50px; margin: 0 auto;" alt="Image">';
                    }
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('Category.edit', $row->id);
                    $deleteUrl = route('Category.destroy', $row->id);
                    $action = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a> &nbsp'
                        . '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_button"> <i class="fas fa-trash-alt"></i></button>';

                    return $action;
                })


                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['image', 'action'])
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
        // dd($request->file('image'));
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
        // dd($request->image);
        $category = new Category();
        $category->name = $validatedData['name'];
        // dd($request->hasFile('image'));
        if ($request->hasFile('image')) {
            // dd(123);
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images', $filename);
            $url = Storage::url($path);
            // dd($url);
            $category->image = $url;
            $category->save();
        }
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
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->save();
        if ($request->hasFile('image')) {
            // dd(123);
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images', $filename);
            $url = Storage::url($path);
            // dd($url);
            $category->image = $url;
            $category->update();
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

