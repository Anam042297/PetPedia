<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Productcategory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;


class ProductCategoryController extends Controller
{
    // Data table
    public function index(Request $request)
    {
        // dd($request);
        if ($request->ajax()) {
            $data = Productcategory::select('id', 'name','icon')
            ->get();
          //  dd($data);
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                   // dd($row);
                    $editUrl = route('ProductCategory.edit', $row->id);
                    $deleteUrl = route('ProductCategory.destroy', $row->id);
                    $action = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>'
                   
                        . '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_button"> Delete</button>';

                    return $action;
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.productcategory.view');
    }

    // View data table view blade
    public function viewcategory()
    {
        return view('dashboard.productcategory.view');
    }

    // Create category
    public function create()
    {
        return view('dashboard.productcategory.create');
    }

 
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $iconPath = $request->file('icon')->store('icons', 'public');
    
        $productCategory = new ProductCategory();
        $productCategory->name = $validatedData['name'];
        $productCategory->icon = $iconPath;
        $productCategory->save();
    
        return redirect()->route('ProductCategory.index')->with('success', 'Category added successfully.');
    }
     // Edit view category data
    public function edit($id)
    {
        $productCategory = Productcategory::findOrFail($id);
      // dd( $category);
        return view('dashboard.productcategory.create', compact('productCategory'));
    }
    public function update(Request $request, $id)
    {
        $productCategory = Productcategory::findOrFail($id);
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public');
            $productCategory->icon = $iconPath;
        }
    
        $productCategory->name = $validatedData['name'];
        $productCategory->save();
    
        return redirect()->route('ProductCategory.index')->with('success', 'Category updated successfully.');
    }
    
    // Delete category
    public function destroy($id)
    {  //  dd($id);
        $productCategory = Productcategory::find($id);  
// dd($category);
        if (!$productCategory) {
            return response()->json(['error' => 'Category not found.'], 404);
        }

        $productCategory->delete();
        return response()->json(['success' => 'Category deleted successfully.']);
    }
}
