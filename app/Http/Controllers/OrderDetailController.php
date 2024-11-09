<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderDetails = OrderDetail::all();
        return response()->json($orderDetails);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kiểm tra và xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Kiểm tra xem OrderDetail đã tồn tại hay chưa
        $existingOrderDetail = OrderDetail::where('order_id', $validatedData['order_id'])
                                           ->where('product_id', $validatedData['product_id'])
                                           ->first();

        if ($existingOrderDetail) {
            // Nếu OrderDetail đã tồn tại thì trả về lỗi
            return response()->json([
                'error' => 'OrderDetail with this order_id and product_id already exists.',
            ], 400);
        }

        // Tạo mới OrderDetail
        $orderDetail = OrderDetail::create($validatedData);

        // Kiểm tra xem OrderDetail có được tạo không
        if ($orderDetail) {
            return response()->json($orderDetail, 201); // 201 OK nghĩa là đã tạo thành công
        }

        // Trả về lỗi nếu không tạo được OrderDetail
        return response()->json(['error' => 'Failed to create OrderDetail.'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDetail $orderDetail)
    {
        return response()->json($orderDetail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        $validatedData = $request->validate([
            'order_id' => 'exists:orders,id',       // Không cần 'required'
            'product_id' => 'exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        // Kiểm tra xem OrderDetail với order_id và product_id đã tồn tại chưa (ngoại trừ bản ghi hiện tại)
        if (isset($validatedData['order_id']) && isset($validatedData['product_id'])) {
            $existingOrderDetail = OrderDetail::where('order_id', $validatedData['order_id'])
                                               ->where('product_id', $validatedData['product_id'])
                                               ->where('id', '!=', $orderDetail->id)
                                               ->first();

            if ($existingOrderDetail) {
                return response()->json([
                    'error' => 'OrderDetail with this order_id and product_id already exists.',
                ], 400);
            }
        }

        // Điền dữ liệu mới vào orderDetail và kiểm tra nếu có sự thay đổi
        $orderDetail->fill($validatedData);

        if ($orderDetail->isDirty()) {
            $orderDetail->save();
            return response()->json($orderDetail, 200);
        }

        // Trả về thông báo nếu không có thay đổi
        return response()->json(['message' => 'No changes were made to the order detail.'], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();
        return response()->json(null, 204);
    }
}
