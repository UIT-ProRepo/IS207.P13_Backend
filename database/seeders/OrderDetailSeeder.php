<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderDetail;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Chi tiết cho Order 10
        OrderDetail::create([
            'order_id' => 10,
            'product_id' => 11,
            'quantity' => 2,
        ]);
        OrderDetail::create([
            'order_id' => 10,
            'product_id' => 48,
            'quantity' => 1,
        ]);

        // Chi tiết cho Order 11
        OrderDetail::create([
            'order_id' => 11,
            'product_id' => 23,
            'quantity' => 1,
        ]);
        OrderDetail::create([
            'order_id' => 11,
            'product_id' => 36,
            'quantity' => 2,
        ]);

        // Chi tiết cho Order 12
        OrderDetail::create([
            'order_id' => 12,
            'product_id' => 36,
            'quantity' => 3,
        ]);
        OrderDetail::create([
            'order_id' => 12,
            'product_id' => 57,
            'quantity' => 1,
        ]);

        // Chi tiết cho Order 13
        OrderDetail::create([
            'order_id' => 13,
            'product_id' => 48,
            'quantity' => 2,
        ]);
        OrderDetail::create([
            'order_id' => 13,
            'product_id' => 63,
            'quantity' => 1,
        ]);

        // Chi tiết cho Order 14
        OrderDetail::create([
            'order_id' => 14,
            'product_id' => 57,
            'quantity' => 4,
        ]);
        OrderDetail::create([
            'order_id' => 14,
            'product_id' => 86,
            'quantity' => 2,
        ]);

        // Chi tiết cho Order 15
        OrderDetail::create([
            'order_id' => 15,
            'product_id' => 63,
            'quantity' => 2,
        ]);
        OrderDetail::create([
            'order_id' => 15,
            'product_id' => 72,
            'quantity' => 1,
        ]);

        // Chi tiết cho Order 16
        OrderDetail::create([
            'order_id' => 16,
            'product_id' => 72,
            'quantity' => 1,
        ]);
        OrderDetail::create([
            'order_id' => 16,
            'product_id' => 86,
            'quantity' => 3,
        ]);

        // Chi tiết cho Order 17
        OrderDetail::create([
            'order_id' => 17,
            'product_id' => 86,
            'quantity' => 3,
        ]);
        OrderDetail::create([
            'order_id' => 17,
            'product_id' => 91,
            'quantity' => 1,
        ]);

        // Chi tiết cho Order 18
        OrderDetail::create([
            'order_id' => 18,
            'product_id' => 91,
            'quantity' => 1,
        ]);
        OrderDetail::create([
            'order_id' => 18,
            'product_id' => 45,
            'quantity' => 2,
        ]);

        // Chi tiết cho Order 19
        OrderDetail::create([
            'order_id' => 19,
            'product_id' => 45,
            'quantity' => 2,
        ]);
        OrderDetail::create([
            'order_id' => 19,
            'product_id' => 38,
            'quantity' => 1,
        ]);
    }
}
