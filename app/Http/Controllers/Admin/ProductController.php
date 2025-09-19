<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ambil produk terbaru, include relasi kategori & user (jika ada)
        $products = Product::with(['category'])
                        ->latest()
                        ->paginate(3);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'        => 'required|string|max:255',
            'category_id' => 'required',  // Remove exists validation
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ],[
            'name.required'        => 'Product name is required',
            'category_id.required' => 'Category is required',
            'price.required'       => 'Price is required',
            'price.numeric'        => 'Price must be a number',
            'price.min'            => 'Price cannot be negative',
            'stock.required'       => 'Stock is required',
            'stock.integer'        => 'Stock must be a whole number',
            'stock.min'            => 'Stock cannot be negative',
            'image.image'          => 'File must be an image',
            'image.mimes'          => 'Image must be jpg, jpeg, or png',
            'image.max'            => 'Image size cannot exceed 2MB'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle category
        $category_id = $request->category_id;
        // If category_id is not numeric, it's a new category
        if (!is_numeric($category_id)) {
            $category = Category::create([
                'name' => $category_id,
                'slug' => Str::slug($category_id)
            ]);
            $category_id = $category->id;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'category_id' => $category_id, // Use the new or existing category_id
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
            'image'       => $imagePath,
            'status'      => 'active',
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
