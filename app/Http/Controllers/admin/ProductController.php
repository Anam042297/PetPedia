<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DataTables;

class ProductController extends Controller
{
    // Display a listing of the products with DataTables
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::query()->with(['user','category','productCategory', 'productImages'])->get();
            return DataTables::of($products)
                ->addColumn('action', function ($row) {
                    $editUrl = route('products.edit', $row->id);
                    $deleteUrl = route('products.destroy', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>&nbsp'
                        . '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_product_button"><i class="fa-solid fa-trash-can"></i></button>';
                    })
                    ->addColumn('category', function ($row) {
                        return $row->category ? $row->category->name : 'N/A';
                    })
                ->addColumn('price', function ($row) {
                    return $row->price ?  '$'. number_format($row->price, 2) : 'N/A'; // Formats the price to include a dollar sign and two decimal places
                })
                ->addColumn('product_category', function ($row) {
                    return $row->productCategory ? $row->productCategory->name : 'N/A';
                })
                ->addColumn('weight', function ($row) {
                    return $row->weight ? $row->weight . ' g' : 'N/A';
                })
                ->addColumn('brand', function ($row) {
                    return $row->brand ?? 'N/A';
                })
                ->addColumn('stock', function ($row) {
                    return $row->stock;
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
        return view('dashboard.products.viewproduct');
    }

    // Show the form for creating a new product
    public function create(Request $request)
    {
        // dd($request->all);
        $categories = Category::all();
        $productcategories = ProductCategory::all();
        // dd($productcategories);
        return view('dashboard.products.createproduct', compact('categories','productcategories'));
    }

    // Store a newly created product in the database
    public function store(Request $request)
    { 
        //  dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1',
            'product_category_id' => 'required|exists:product_categories,id',
            'weight' => 'required|integer|min:0',
            'brand' => 'required|string|max:255',
            'stock' => 'required|integer|min:1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $randomNumber = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $validatedData['user_id'] = Auth::id();
        $validatedData['serial_number'] = $randomNumber;

        // Create a new product instance
        $product = Product::create($validatedData);
// dd($request->hasFile('images'));
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
        $categories = Category::all();
        $productcategories = ProductCategory::all();
        return view('dashboard.products.editproduct', compact('product', 'categories', 'productcategories'));
    }
    
    // Update the specified product in the database
    public function update(Request $request, $id)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'product_category_id' => 'required|exists:product_categories,id',
            'weight' => 'required|numeric|min:0',
            'brand' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
// dd($validatedData);
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
        $product = Product::with('productimages')->findOrFail($id);
        // dd($product);
        foreach ($product->productimages as $image) {
            Storage::delete($image->image_path); // Remove image from storage
            $image->delete(); // Delete record from the database
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
