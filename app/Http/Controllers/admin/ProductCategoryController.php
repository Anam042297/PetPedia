<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;


class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        if ($request->ajax()) {
            $data = ProductCategory::select('id', 'name', 'icon')->get();
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

    public function viewcategory()
    {
        return view('dashboard.productcategory.view');
    }

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

        $productcategory = new ProductCategory();
        $productcategory->name = $validatedData['name'];
        $productcategory->icon = $iconPath;
        $productcategory->save();
        return redirect()->route('ProductCategory.index')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $productcategory = ProductCategory::findOrFail($id);
        // dd( $productcategory);
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

    public function destroy($id)
    {  //  dd($id);
        $productcategory = ProductCategory::find($id);
        // dd($productcategory);
        if (!$productcategory) {
            return response()->json(['error' => 'Category not found.'], 404);
        }

        $productcategory->delete();
        return response()->json(['success' => 'Category deleted successfully.']);
    }
}
