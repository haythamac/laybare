<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class ProductController extends Controller
{
    public function main(Request $request)
    {
        $categories = Category::all();
        $productsByCategory = [];

        $query = Category::query();
        $selectedCategory = [];

        // Filter Category
        if ($request->filter_category == 'all' || $request->filter_category == null) 
        {
            $selectedCategory = $categories;
        } else {
            $query->where('id', $request->filter_category);
            $selectedCategory = $query->get();
        }

        // Sort
        $sortOrder = $request->has('sort') && $request->sort == 'desc' ? 'desc' : 'asc';
        // Search
        $searchTerm = $request->input('search');

        foreach ($categories as $category) {
            $query = Product::where('product_category_id', $category->id)
                ->orderBy('product_name', $sortOrder)
                ->orderByDesc('updated_at')
                ->orderByDesc('created_at');
    
            if ($searchTerm) {
                $query->where('product_name', 'like', '%' . $searchTerm . '%');
            }
    
            $productsByCategory[$category->id] = $query->paginate(4, ['*'], $category->id);
        }
        return view('products.main', compact('categories', 'productsByCategory', 'selectedCategory', 'sortOrder', 'searchTerm'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function index()
    {
        $categories = Category::all();
        $users = User::all();
        $products = Product::with('category')
            ->orderByDesc('updated_at')
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('products.index', compact('products', 'categories', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'product_sku' => 'required|max:8',
            'product_category_id' => 'required|exists:categories,id',
            'product_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validate image type and size
            'user_id' => 'required|exists:users,id',
        ]);

        $category = Category::find($validated['product_category_id']);

        // Get the original file name
        $originalFileName = $request->file('image')->getClientOriginalName();
        $imageName = time() . '.' . $originalFileName;
        $request->image->move('product-img', $imageName);

        $product = Product::create([
            'product_name' => $validated['product_name'],
            'product_sku' => $validated['product_sku'],
            'product_description' => $validated['product_description'],
            'product_category' => $category->category_name,
            'product_category_id' => $validated['product_category_id'],
            'user_id' => $validated['user_id'],
            'product_image' => $imageName
        ]);

        session()->flash('message', 'Product added successfully');
        return redirect()->back();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $users = User::all();
        $categories = Category::all();

        $creator = User::find($product->user_id);
        return view('products.edit', compact('product', 'users', 'categories', 'creator'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'product_sku' => 'required|max:8',
            'product_category_id' => 'required',
            'product_description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);
        $category = Category::find($validated['product_category_id']);

        // Check if an image is uploaded
        if ($request->hasFile('image')) {
            // Get the original file name
            $originalFileName = $request->file('image')->getClientOriginalName();
            $imageName = time() . '.' . $originalFileName;

            // Move and update the image
            $request->image->move('product-img', $imageName);
            $product->update(['product_image' => $imageName]);
        }

        $product->update([
            'product_name' => $validated['product_name'],
            'product_sku' => $validated['product_sku'],
            'product_description' => $validated['product_description'],
            'product_category' => $category->category_name,
            'product_category_id' => $validated['product_category_id'],
            'user_id' => $validated['user_id'],
        ]);

        session()->flash('message', 'Product updated successfully');
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        session()->flash('message', 'Category deleted successfully');
        return redirect()->back();
    }
}
