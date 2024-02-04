<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('category_name')->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_name' => 'required|max:255',
            'category_description' => 'required',
            'product_manager' => 'required|numeric'
        ]);

        $category = Category::create($validated);
        session()->flash('message', 'Category added successfully');

        return redirect()->back();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_name' => 'required|max:255',
            'category_description' => 'required',
            'product_manager' => 'required|numeric'
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'category_name' => $request->input('category_name'),
            'category_description' => $request->input('category_description'),
            'product_manager' => $request->input('product_manager'),
        ]);

        session()->flash('message', 'Category updated successfully');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        session()->flash('message', 'Category deleted successfully');
        return redirect()->back();
    }
}
