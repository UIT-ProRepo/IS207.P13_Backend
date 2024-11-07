<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $addresses = Address::all();
        return response()->json($addresses, Response::HTTP_OK);
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
        $request->validate([
            'province' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'detail' => 'required|string|max:255',
        ]);

        $address = Address::create([
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward,
            'detail' => $request->detail,
        ]);

        return response()->json($address, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        // $address = Address::find($id);
        
        if (!$address) {
            return response()->json(['message' => 'Address not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($address, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $address = Address::find($id);
        
        if (!$address) {
            return response()->json(['message' => 'Address not found'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'province' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'detail' => 'required|string|max:255',
        ]);

        $address->update([
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward,
            'detail' => $request->detail,
        ]);

        return response()->json($address, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $address = Address::find($id);
        
        if (!$address) {
            return response()->json(['message' => 'Address not found'], Response::HTTP_NOT_FOUND);
        }

        $address->delete();
        return response()->json(['message' => 'Address deleted successfully'], Response::HTTP_OK);
    }
}
