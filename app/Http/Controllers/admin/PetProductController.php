<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PetProduct;
use App\Models\ProductImage;
use App\Models\PetCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;

class PetProductController extends Controller
{
    // Display a listing of the products with DataTables
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = PetProduct::query()->with(['user', 'Category', 'images'])->select('pet_products.*');
            //    dd( $products);
            return DataTables::of($products)

                ->addColumn('action', function ($row) {
                    $editUrl = route('products.edit', $row->id);
                    $deleteUrl = route('products.destroy', $row->id);
                    $action = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>'
                        . '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_product_button">Delete</button>';
                    return $action;
                })

                ->addColumn('category', function ($row) {
                    return $row->category ? $row->category->name : 'N/A';
                })
              
                ->addColumn('weight', function ($row) {
                    return $row->weight ? $row->weight . ' kg' : 'N/A';
                })
                ->addColumn('company', function ($row) {
                    return $row->company ?? 'N/A';
                })
                ->addColumn('quantity', function ($row) {
                    return $row->quantity;
                })
                ->addColumn('images', function ($row) {
                    if ($row->images->isEmpty()) {
                        return ''; // Return empty if there are no images
                    }

                    $firstImage = $row->images->first();
                    //  dd($firstImage->image_path);
                    return '<img src="' . $firstImage->image_path . '" class="d-block w-100" alt="Image">';
                    
                })

                ->rawColumns(['images', 'action'])
                ->make(true);
        }
        return view('dashboard.petproducts.viewproduct');
    }

    // Show the form for creating a new product
    public function create()
    {
        $categories = PetCategory::all();
        // dd($categories );
        return view('dashboard.petproducts.createproduct', compact('categories'));
    }

    // Store a newly created product in the database
    public function store(Request $request)
    { // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:food,accessory',
            'price' => 'required|numeric',
            'pet_category_id' => 'required|exists:pet_categories,id',
            'weight' => 'nullable|numeric', // Added validation for weight
            'company' => 'nullable|string', // Added validation for company
            'quantity' => 'required|integer|min:0', // Added validation for quantity
           'images.*' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
        $randomNumber = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
// dd($randomNumber);
        $validatedData['user_id'] = Auth::id();
$validateData['serial_number'] =  $randomNumber;
        // Create a new product instance
        // dd($validateData);
        $product = petproduct::create($validatedData);

        // Handle uploading and associating images
        if ($request->hasFile('images')) {
            //  dd($request);
            foreach ($request->file('images') as $image) {
                // dd($request);
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/product_images', $filename);
                //   dd($path);
                $url = Storage::url($path);
                // dd($url);
                productimage::create([
                    'product_id' => $product->id,
                    'image_path' => $url,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    // Show the form for editing the specified product
    public function edit(PetProduct $product, $id)
    {
        // dd($product);
        // $product = PetProduct::with('Category')->findOrFail($id);
        // dd($product);
        $product = PetProduct::findOrFail($id);
        $categories = PetCategory::all();
        return view('dashboard.petproducts.editproduct', compact('product', 'categories'));
    }
    // Update the specified product in the database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:food,accessory',
            'price' => 'required|numeric',
            'pet_category_id' => 'required|exists:pet_categories,id',
            'weight' => 'nullable|numeric', // Added validation for weight
            'company' => 'nullable|string', // Added validation for company
            'quantity' => 'required|integer|min:0', // Added validation for quantity
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

      
    ]);
    $product = PetProduct::findOrFail($id);
    $product->update($validatedData);
    if ($request->hasFile('images')) {
        // Delete old images if new ones are uploaded
        foreach ($product->images as $image) {
            Storage::delete($image->image_path);
            $image->delete();
        }

        // Store new images
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
    $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
    public function showProductPage($id)
    {
        $petproduct = PetProduct::findOrFail($id); // Fetch the product based on ID
        return view('frontend.product_page', compact('petproduct')); // Pass the product to the view
    }

    // Remove the specified product from the database
    public function destroy(string $id)
    {
        $product = PetProduct::with('images')->findorfail($id);
        if (!$product) {
            return response()->json(['error' => 'product not found ".'], 404);
        }
        // Delete associated images from storage
        foreach ($product->images as $image) {
            Storage::delete('public/' . $image->image_path);
            $image->delete(); // Delete the image record from the database
        }

        // Delete the product itself
        $product->delete();

        return response()->json(['success' => 'Product deleted successfully!']);
    }
}
