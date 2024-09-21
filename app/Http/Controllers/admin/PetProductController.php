<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DataTables;

class PetProductController extends Controller
{
    // Display a listing of the products with DataTables
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::query()->with(['user', 'productCategory', 'productImages'])->select('products.*');
            return DataTables::of($products)
                ->addColumn('action', function ($row) {
                    $editUrl = route('products.edit', $row->id);
                    $deleteUrl = route('products.destroy', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>'
                        . '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_product_button">Delete</button>';
                })
                ->addColumn('category', function ($row) {
                    return $row->productCategory ? $row->productCategory->name : 'N/A';
                })
                ->addColumn('weight', function ($row) {
                    return $row->weight ? $row->weight . ' kg' : 'N/A';
                })
                ->addColumn('brand', function ($row) {
                    return $row->brand ?? 'N/A';
                })
                ->addColumn('quantity', function ($row) {
                    return $row->quantity;
                })
                ->addColumn('images', function ($row) {
                    if ($row->productImages->isEmpty()) {
                        return '<img src="/path/to/placeholder.png" class="d-block w-100" alt="No Image">';
                    }
                    $firstImage = $row->productImages->first();
                    return '<img src="' . $firstImage->image_path . '" class="d-block w-100" alt="Product Image">';
                })
                
                ->rawColumns(['images', 'action'])
                ->make(true);
        }
        return view('dashboard.petproducts.viewproduct');
    }

    // Show the form for creating a new product
    public function create()
    {
        $categories = ProductCategory::all();
        return view('dashboard.petproducts.createproduct', compact('categories'));
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'pet_type' => 'required|in:dog,cat,bird',
            'price' => 'required|numeric',
            'product_category_id' => 'required|exists:product_categories,id',
            'weight' => 'nullable|numeric',
            'brand' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $randomNumber = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $validatedData['user_id'] = Auth::id();
        $validatedData['serial_number'] = $randomNumber;

        // Create a new product instance
        $product = Product::create($validatedData);

        // Handle uploading and associating images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('public/product_images', $filename);
                $url = Storage::url($path);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $url,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    // Show the form for editing the specified product
    public function edit(Product $product, $id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        return view('dashboard.petproducts.editproduct', compact('product', 'categories'));
    }

    // Update the specified product in the database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'pet_type' => 'required|in:dog,cat,bird',
            'price' => 'required|numeric',
            'product_category_id' => 'required|exists:product_categories,id',
            'weight' => 'nullable|numeric',
            'brand' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        // Handle image updates
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('public/product_images', $filename);
                $url = Storage::url($path);
                ProductImage::updateOrCreate(
                    ['product_id' => $product->id],
                    ['image_path' => $url]
                );
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Remove the specified product from the database
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        foreach ($product->productImages as $image) {
            Storage::delete($image->image_path); // Remove image from storage
            $image->delete(); // Delete record from the database
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
