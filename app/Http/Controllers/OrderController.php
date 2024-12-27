<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Address;
use App\Models\ShippingProvider;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        $orders->load('orderDetails.product');
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order.user_id' => 'required|exists:users,id',
            'order.order_date' => 'required|date',
            'order.total_price' => 'required|numeric',
            'order.payment_method' => 'required|in:Cash,CreditCard',
            'order.order_items' => 'required|array|min:1',
            'order.order_items.*.id' => 'required|exists:products,id',
            'order.order_items.*.quantity' => 'required|integer|min:1',
            'address.province' => 'required|string',
            'address.district' => 'required|string',
            'address.ward' => 'required|string',
            'address.detail' => 'required|string',
        ]);

        $orderDate = \Carbon\Carbon::parse($validatedData['order']['order_date'])->format('Y-m-d H:i:s');

        $address = Address::create($validatedData['address']);

        $shippingProvider = ShippingProvider::inRandomOrder()->first();

        $deliveryStatuses = ['Fail', 'Success'];
        $randomDeliveryStatus = $deliveryStatuses[array_rand($deliveryStatuses)];

        $orderData = array_merge($validatedData['order'], [
            'order_date' => $orderDate,
            'address_id' => $address->id,
            'shipping_provider_id' => $shippingProvider->id,
            'delivery_status' => $randomDeliveryStatus,
        ]);
        $order = Order::create($orderData);

        $orderItems = $validatedData['order']['order_items'];
        foreach ($orderItems as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json([
            'message' => 'Order created successfully.',
            'order' => $order,
            'address' => $address,
            'shipping_provider' => $shippingProvider,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Tính lại tổng giá tiền của order
        $this->calculateTotalPrice($order->id);
        $order->refresh(); // Refresh để lấy total_price đã được cập nhật

        // Load order details liên quan
        $order->load('orderDetails.product'); // Giả sử bạn đã thiết lập quan hệ hasMany

        return response()->json([
            'order' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'user_id' => 'exists:users,id',
            'shop_id' => 'exists:shops,id',
            'shipping_provider_id' => 'exists:shipping_providers,id',
            'address_id' => 'exists:addresses,id',
            'order_date' => 'date',
            'note' => 'nullable|string|max:100',
            'payment_method' => 'in:Cash,CreditCard',
            'delivery_status' => 'in:Pending,Success,Fail',
        ]);

        $order->fill($validatedData);

        if ($order->isDirty()) {
            $order->save();
            $this->calculateTotalPrice($order->id);
            return response()->json($order, 200);
        }

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
        $order = Order::with('orderDetails.product')->findOrFail($orderId);

        $totalPrice = $order->orderDetails->sum(function ($detail) {
            return $detail->quantity * ($detail->product->unit_price ?? 0);
        });

        $order->update(['total_price' => $totalPrice]);

        return response()->json([
            'total_price' => $totalPrice,
            'order' => $order,
        ]);
    }
}
