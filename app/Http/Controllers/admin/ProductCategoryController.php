<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;


class ProductCategoryController extends Controller
{
    // Data table
    public function index(Request $request)
    {
        // dd($request);
        if ($request->ajax()) {
            $data = ProductCategory::select('id', 'name', 'icon')
                ->get();
            //  dd($data);
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    // dd($row);
                    $editUrl = route('ProductCategory.edit', $row->id);
                    $deleteUrl = route('ProductCategory.destroy', $row->id);
                    $action = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>&nbsp'

                        . '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_button"><i class="fa-solid fa-trash-can"></i></button>';

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


        $productcategory= new ProductCategory();
        $productcategory->name = $validatedData['name'];
        if ($request->hasFile('icon')) {
            // dd(123);
            $image = $request->file('icon');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/icon', $filename);
            $url = Storage::url($path);
            // dd($url);
            $productcategory->icon= $url;
            $productcategory->save();
        }
        return redirect()->route('ProductCategory.index')->with('success', 'Category added successfully.');
    }
    // Edit view category data
    public function edit($id)
    {
        $productcategory = ProductCategory::findOrFail($id);
        // dd( $category);
        return view('dashboard.productcategory.create', compact('productcategory'));
    }
    public function update(Request $request, $id)
    {
        $productcategory = ProductCategory::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public');
            $productcategory->icon = $iconPath;
        }

        $productcategory->name = $validatedData['name'];
        $productcategory->save();

        return redirect()->route('ProductCategory.index')->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy($id)
    {  //  dd($id);
        $productcategory = ProductCategory::find($id);
        // dd($category);
        if (!$productcategory) {
            return response()->json(['error' => 'Category not found.'], 404);
        }

        $productcategory->delete();
        return response()->json(['success' => 'Category deleted successfully.']);
    }
}
