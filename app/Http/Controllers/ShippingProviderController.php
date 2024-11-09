<?php

namespace App\Http\Controllers;

use App\Models\ShippingProvider;
use Illuminate\Http\Request;

class ShippingProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippingProviders = ShippingProvider::all();
        return response()->json($shippingProviders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $shippingProvider = ShippingProvider::create($validatedData);
        return response()->json($shippingProvider, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingProvider $shippingProvider)
    {
        return response()->json($shippingProvider);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShippingProvider $shippingProvider)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
        ]);

        $shippingProvider->update($validatedData);
        return response()->json($shippingProvider);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingProvider $shippingProvider)
    {
        $shippingProvider->delete();
        return response()->json(null, 204);
    }
}
