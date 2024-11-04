<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $discounts = Discount::all();
        return response()->json($discounts);
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
            'product_id' => 'required|exists:products,id',
            'is_percent' => 'required|boolean',
            'amount' => 'required|integer',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $discount = Discount::create($validatedData);
        return response()->json($discount, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
        return response()->json($discount);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        //
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'is_percent' => 'required|boolean',
            'amount' => 'required|integer',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $discount->update($validatedData);
        return response()->json($discount);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        //
        $discount->delete();
        return response()->json(null, 204);
    }
}
