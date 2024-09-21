<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;


class ProductPetCategoryController extends Controller
{
    // Data table
    public function index(Request $request)
    {
        // dd($request);
        if ($request->ajax()) {
            $data = ProductCategory::select('id', 'name','icon')
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

    // Store category data
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     // Validate incoming request data
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'icon' => 'required|image|mimes:jpeg,png,jpg,gif',
    //     ]);
    //     $iconPath = $request->file('icon')->store('icons', 'public');
    //     // Create a new PetCategory instance
    //     $category = new Product_category();
    //     $category->name = $validatedData['name'];
    //     $category->icon = $iconPath; 
    
    //     // dd($category);
    //     $category->save();
    //     //dd( $category);
    //     // Redirect to a success page or route
    //     return redirect()->route('PetCategory.index')->with('success', 'Category added successfully.');
    // }

    // // Edit view category data
    // public function edit($id)
    // {
    //     $category = Product_category::findOrFail($id);
    //   // dd( $category);
    //     return view('dashboard.productpetcategory.create', compact('category'));
    // }

    // // Store edited category
    // public function update(Request $request, $id)
    // {   //dd($id);
    //     // dd($request);
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'icon' => 'required|image|mimes:jpeg,png,jpg,gif',
    //     ]);


    //     // dd($category);
    //     $category = Product_category::findOrFail($id);
    //     $category->name = $request->input('name');

    //     // Update icon only if a new one is uploaded
    //     if ($request->hasFile('icon')) {
    //         // Delete the old icon if necessary
    //         Storage::disk('public')->delete($category->icon);
    //         // Store the new icon and update the path
    //         $category->icon = $request->file('icon')->store('icons', 'public');
    //     }
    //     $category->save();

    //     return redirect()->route('PetCategory.index')->with('success', 'Category updated successfully.');
    // }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $iconPath = $request->file('icon')->store('icons', 'public');
    
        $category = new ProductCategory();
        $category->name = $validatedData['name'];
        $category->icon = $iconPath;
        $category->save();
    
        return redirect()->route('ProductCategory.index')->with('success', 'Category added successfully.');
    }
     // Edit view category data
    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
      // dd( $category);
        return view('dashboard.productcategory.create', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public');
            $category->icon = $iconPath;
        }
    
        $category->name = $validatedData['name'];
        $category->save();
    
        return redirect()->route('ProductCategory.index')->with('success', 'Category updated successfully.');
    }
    
    // Delete category
    public function destroy($id)
    {  //  dd($id);
        $category = ProductCategory::find($id);  
// dd($category);
        if (!$category) {
            return response()->json(['error' => 'Category not found.'], 404);
        }

        $category->delete();
        return response()->json(['success' => 'Category deleted successfully.']);
    }
}
