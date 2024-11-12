<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Address;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review = Review::all();
        $review = $review->load('product');
        $review = $review->load('user');

        return response()->json($review);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'approval_status' => 'in:pending,approved,rejected',
        ]);

        if (!isset($validatedData['approval_status'])) {
            $validatedData['approval_status'] = 'pending';
        }

        $review = Review::create($validatedData);

        return response()->json($review, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review->load('product');
        $review->load('user');

        return response()->json($review); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $validatedData = $request->validate([
            'comment' => 'string',
            'rating' => 'integer|min:1|max:5',
            'approval_status' => 'in:pending,approved,rejected',            
        ]);

        $review->update($validatedData);

        return response()->json($review);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(null, 204);
    }
}
