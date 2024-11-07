<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Kiểm tra xem người dùng hiện tại có phải là admin không
        if (Auth::user()->role === 'admin') {
            // Admin có thể xem tất cả các review
            $reviews = Review::all();
        } else {
            // Người dùng thường chỉ có thể xem review đã được duyệt
            $reviews = Review::where('is_approved', true)->get();
        }

        return response()->json($reviews);
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
            'product_id' => 'required|exists:products,id',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'is_approved' => false // Mặc định là chưa được duyệt
        ]);

        return response()->json($review, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
        // Kiểm tra nếu review chưa được duyệt và người dùng không phải là admin
        if (!$review->is_approved && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        return response()->json($review);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
         // Chỉ cho phép người tạo review hoặc admin cập nhật
         if (Auth::id() !== $review->user_id && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $request->validate([
            'comment' => 'string',
            'rating' => 'integer|min:1|max:5',
        ]);
    
        $review->update($request->only('comment', 'rating'));
    
        return response()->json($review);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
        // Chỉ cho phép người tạo review hoặc admin xóa review
        if (Auth::id() !== $review->user_id && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $review->delete();
    
        return response()->json(['message' => 'Review deleted successfully']);
    }

    /**
     * Approve a review (Admin only).
     */
    public function approve($id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        // Truy vấn đúng với id
        $review = Review::findOrFail($id);
    
        // Cập nhật trường is_approved
        $review->is_approved = true;
        $review->save();
    
        return response()->json($review, 200);
    }


}
