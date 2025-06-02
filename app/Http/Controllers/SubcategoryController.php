<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index() {
        return Subcategory::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subcategory,name',
            'category_id'      => 'required|exists:category,id',
        ]);

        $data = Subcategory::create($validated);

        return response()->json([
            'message' => 'Subcategory created successfully.',
            'data'    => $data
        ], 201);
    }

    public function show($id)
    {
        $data = Subcategory::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:subcategory,name,' . $id,
            'category_id'      => 'sometimes|exists:category,id',
        ]);

        $data = Subcategory::findOrFail($id);
        $data->update($validated);

        return response()->json([
            'message' => 'Subcategory updated successfully.',
            'data'    => $data
        ]);
    }

    public function destroy($id)
    {
        $data = Subcategory::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'Subcategory deleted successfully.']);
    }
}
