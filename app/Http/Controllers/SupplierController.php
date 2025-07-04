<?php

namespace App\Http\Controllers;

use App\Filters\SupplierFilter;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SuppliersResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request, SupplierFilter $filters)
    {
        $suppliers = Supplier::filter($filters)->paginate($request->input('per_page', 10));
        return SuppliersResource::collection($suppliers);
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());

        return response()->json([
            'message' => 'Supplier created successfully',
        ], 201);
    }

    public function show(Supplier $supplier)
    {
        return response()->json($supplier);
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());

        return response()->json([
            'message' => 'Supplier updated successfully',
        ]);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->json(['message' => 'Supplier deleted successfully']);
    }
}
