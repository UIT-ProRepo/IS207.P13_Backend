<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Address;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shop = Shop::with('address')->get();
        return response()->json($shop);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|min:10|max:11',
            'owner_id' => 'required|integer|exists:users,id',
            'is_alive' => 'boolean',
            'address.province' => 'required|string',
            'address.district' => 'required|string',
            'address.ward' => 'required|string',
            'address.detail' => 'required|string',
        ]);

        $address = Address::create([
            'province' => $validatedData['address']['province'],
            'district' => $validatedData['address']['district'],
            'ward' => $validatedData['address']['ward'],
            'detail' => $validatedData['address']['detail'],
        ]);

        if (!isset($validatedData['is_alive'])) {
            $validatedData['is_alive'] = true;
        }

        $shopData = array_merge($validatedData, ['address_id' => $address->id]);
        $shop = Shop::create($shopData);

        return response()->json($shop, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        $shop->load('address');
        return response()->json($shop); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        $validatedData = $request->validate([
            'name' => 'string',
            'phone' => 'string|min:10|max:11',
            'owner_id' => 'integer|exists:users,id',
            'is_alive' => 'boolean',
            'address.province' => 'string',
            'address.district' => 'string',
            'address.ward' => 'string',
            'address.detail' => 'string',
        ]);

        $shop->update($validatedData);

        if (isset($validatedData['address'])) {
            $shop->address->update($validatedData['address']);
        }

        return response()->json($shop);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return response()->json(null, 204);
    }
}
