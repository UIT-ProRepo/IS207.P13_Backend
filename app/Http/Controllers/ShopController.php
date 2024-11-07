<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $shops = Shop::with(['owner', 'address', 'products'])->get();
        return response()->json($shops);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'owner_id' => 'required|exists:users,id',
            'address_id' => 'required|exists:addresses,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'is_alive' => 'required|boolean',
        ]);

        $shop = Shop::create($validatedData);
        return response()->json($shop, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        //
        $shop->load(['owner', 'address', 'products']);
        return response()->json($shop);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        //
        $validatedData = $request->validate([
            'owner_id' => 'exists:users,id',
            'address_id' => 'exists:addresses,id',
            'name' => 'string|max:255',
            'phone' => 'string|max:15',
            'is_alive' => 'boolean',
        ]);

        $shop->update($validatedData);
        return response()->json($shop);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
        $shop->delete();
        return response()->json(['message' => 'Shop deleted successfully']);
    }
}
