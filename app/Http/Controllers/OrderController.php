<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'shop_id' => 'required|exists:shops,id',
            'shipping_provider_id' => 'required|exists:shipping_providers,id',
            'address_id' => 'required|exists:addresses,id',
            'order_date' => 'required|date',
            'note' => 'nullable|string|max:100',
            'payment_method' => 'required|in:Cash,CreditCard',
            'delivery_status' => 'required|in:Pending,Success,Fail',
        ]);

        // Tạo đơn hàng không cần `total_price` tại thời điểm tạo
        $order = Order::create(array_merge($validatedData, ['total_price' => 0]));

        return response()->json($order, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Tính lại `total_price` nếu cần
        $totalPrice = $order->orderDetails->sum(function ($detail) {
            return $detail->quantity * ($detail->product->price ?? 0);
        });

        // Cập nhật giá trị `total_price` trong `Order` và lưu lại
        $order->update(['total_price' => $totalPrice]);

        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'user_id' => 'exists:users,id', // Không cần 'required'
            'shop_id' => 'exists:shops,id',
            'shipping_provider_id' => 'exists:shipping_providers,id',
            'address_id' => 'exists:addresses,id',
            'order_date' => 'date',
            'note' => 'nullable|string|max:100',
            'payment_method' => 'in:Cash,CreditCard',
            'delivery_status' => 'in:Pending,Success,Fail',
        ]);

        // Áp dụng dữ liệu mới vào model Order, chỉ cập nhật các trường có thay đổi
        $order->fill($validatedData);

        // Kiểm tra và lưu chỉ khi có sự thay đổi
        if ($order->isDirty()) {
            $order->save();
            return response()->json($order, 200);
        }

        // Trả về thông báo nếu không có thay đổi
        return response()->json(['message' => 'No changes were made to the order.'], 200);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }

    public function getOrdersByUserID($user_id)
    {
        $orders = Order::where('user_id', $user_id)->get();
        return response()->json($orders);
    }

    /**
     * Đổi trạng thái đơn hàng thành "Fail".
     */
    public function failOrder($id)
    {
        $order = Order::findOrFail($id);

        // Kiểm tra xem đơn hàng đã được xử lý hay chưa
        if ($order->delivery_status == 'Pending') {
            $order->delivery_status = 'Fail';
            $order->save();
            return response()->json(['message' => 'Order status changed to Fail.', 'order' => $order], 200);
        }

        return response()->json(['message' => 'Only pending orders can be changed to Fail.'], 400);
    }

    /**
     * Lọc đơn hàng theo trạng thái.
     */
    public function filterOrdersByStatus($status)
    {
        $validStatuses = ['Pending', 'Success', 'Fail'];

        if (!in_array($status, $validStatuses)) {
            return response()->json(['message' => 'Invalid order status.'], 400);
        }

        $orders = Order::where('delivery_status', $status)->get();
        return response()->json($orders);
    }

    public function calculateTotalPrice($orderId)
    {
        // Lấy order và liên kết với order details và product
        $order = Order::with('orderDetails.product')->findOrFail($orderId);

        // Tính tổng giá trị của đơn hàng
        $totalPrice = $order->orderDetails->sum(function ($orderDetail) {
            return $orderDetail->quantity * ($orderDetail->product->price ?? 0);
        });

        // Cập nhật giá trị total_price và lưu lại order
        $order->update(['total_price' => $totalPrice]);

        return response()->json([
            'total_price' => $totalPrice,
            'order' => $order
        ]);
    }
}
