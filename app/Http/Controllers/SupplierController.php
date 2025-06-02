<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index() {
        return Supplier::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'alamat'        => 'required|string|max:255',
            'contact'       => 'required|string|max:255'
        ]);

        $data = Supplier::create($validated);

        return response()->json(['message' => 'Supplier created successfully.', 'data' => $data], 201);
    }

    public function show($id)
    {
        return response()->json(Supplier::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'          => 'sometimes|string|max:255',
            'alamat'        => 'nullable|string|max;255',
            'contact'       => 'nullable|string|max:255'
        ]);

        $data = Supplier::findOrFail($id);
        $data->update($validated);

        return response()->json(['message' => 'Supplier updated successfully.', 'data' => $data]);
    }

    public function destroy($id)
    {
        $data = Supplier::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'Supplier deleted successfully.']);
    }
}
