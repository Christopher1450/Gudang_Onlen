<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController {
    public function index() {
        return Category::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:category,name|max:255',
        ]);

        $data = Category::create($validated);
        return response()->json(['message' => 'Category created successfully.', 'data' => $data], 201);
    }

    public function show($id)
    {
        return response()->json(Category::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return response()->json(['message' => 'Category updated successfully.', 'data' => $category]);
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json(['message' => 'Category deleted successfully.']);
    }
    public function getSubcategory($id)
    {
        $category = Category::with('subcategory')->findOrFail($id);
        return response()->json($category->subcategory);
    }
}
