<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PetCategory;
use Yajra\DataTables\Facades\DataTables;

class ProductPetCategoryController extends Controller
{
    // Data table
    public function index(Request $request)
    {
        // dd($request);
        if ($request->ajax()) {
            $data = PetCategory::select('id', 'name')
            ->get();
          //  dd($data);
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                   // dd($row);
                    $editUrl = route('PetCategory.edit', $row->id);
                    $deleteUrl = route('PetCategory.destroy', $row->id);
                    $action = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>'
                        . '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_button"> Delete</button>';

                    return $action;
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.productpetcategory.view');
    }

    // View data table view blade
    public function viewcategory()
    {
        return view('dashboard.productpetcategory.view');
    }

    // Create category
    public function create()
    {
        return view('dashboard.productpetcategory.create');
    }

    // Store category data
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new PetCategory instance
        $category = new PetCategory();
        $category->name = $validatedData['name'];
        // dd($category);
        $category->save();
        //dd( $category);
        // Redirect to a success page or route
        return redirect()->route('PetCategory.index')->with('success', 'Category added successfully.');
    }

    // Edit view category data
    public function edit($id)
    {
        $category = PetCategory::findOrFail($id);
      // dd( $category);
        return view('dashboard.productpetcategory.create', compact('category'));
    }

    // Store edited category
    public function update(Request $request, $id)
    {   //dd($id);
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = PetCategory::findOrFail($id);
        //  dd($category);
        $category->name = $request->input('name');
        // dd($category);
        $category->save();

        return redirect()->route('PetCategory.index')->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy($id)
    {  //  dd($id);
        $category = PetCategory::find($id);  
// dd($category);
        if (!$category) {
            return response()->json(['error' => 'Category not found.'], 404);
        }

        $category->delete();
        return response()->json(['success' => 'Category deleted successfully.']);
    }
}
