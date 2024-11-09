<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'user_id' => 1,
            'shop_id' => 1,
            'shipping_provider_id' => 1,
            'address_id' => 18,
            'order_date' => Carbon::now()->subDays(10),
            'total_price' => 5000000,
            'note' => 'Giao hàng nhanh',
            'payment_method' => 'Cash',
            'delivery_status' => 'Pending',
        ]);

        Order::create([
            'user_id' => 2,
            'shop_id' => 2,
            'shipping_provider_id' => 2,
            'address_id' => 19,
            'order_date' => Carbon::now()->subDays(8),
            'total_price' => 8700000,
            'note' => 'Liên hệ trước khi giao',
            'payment_method' => 'CreditCard',
            'delivery_status' => 'Success',
        ]);

        Order::create([
            'user_id' => 3,
            'shop_id' => 3,
            'shipping_provider_id' => 3,
            'address_id' => 20,
            'order_date' => Carbon::now()->subDays(6),
            'total_price' => 2500000,
            'note' => 'Giao vào buổi sáng',
            'payment_method' => 'Cash',
            'delivery_status' => 'Fail',
        ]);

        Order::create([
            'user_id' => 4,
            'shop_id' => 1,
            'shipping_provider_id' => 4,
            'address_id' => 24,
            'order_date' => Carbon::now()->subDays(5),
            'total_price' => 5400000,
            'note' => null,
            'payment_method' => 'CreditCard',
            'delivery_status' => 'Pending',
        ]);

        Order::create([
            'user_id' => 5,
            'shop_id' => 2,
            'shipping_provider_id' => 1,
            'address_id' => 25,
            'order_date' => Carbon::now()->subDays(4),
            'total_price' => 1200000,
            'note' => 'Giao hàng cẩn thận',
            'payment_method' => 'Cash',
            'delivery_status' => 'Success',
        ]);

        Order::create([
            'user_id' => 6,
            'shop_id' => 3,
            'shipping_provider_id' => 2,
            'address_id' => 26,
            'order_date' => Carbon::now()->subDays(3),
            'total_price' => 9400000,
            'note' => 'Giao sau 7h tối',
            'payment_method' => 'CreditCard',
            'delivery_status' => 'Pending',
        ]);

        Order::create([
            'user_id' => 7,
            'shop_id' => 1,
            'shipping_provider_id' => 3,
            'address_id' => 27,
            'order_date' => Carbon::now()->subDays(2),
            'total_price' => 3000000,
            'note' => null,
            'payment_method' => 'Cash',
            'delivery_status' => 'Success',
        ]);

        Order::create([
            'user_id' => 8,
            'shop_id' => 2,
            'shipping_provider_id' => 4,
            'address_id' => 28,
            'order_date' => Carbon::now()->subDays(1),
            'total_price' => 8600000,
            'note' => 'Giao càng sớm càng tốt',
            'payment_method' => 'CreditCard',
            'delivery_status' => 'Fail',
        ]);

        Order::create([
            'user_id' => 9,
            'shop_id' => 3,
            'shipping_provider_id' => 1,
            'address_id' => 29,
            'order_date' => Carbon::now(),
            'total_price' => 7900000,
            'note' => 'Giao vào chiều',
            'payment_method' => 'Cash',
            'delivery_status' => 'Pending',
        ]);

        Order::create([
            'user_id' => 10,
            'shop_id' => 1,
            'shipping_provider_id' => 2,
            'address_id' => 30,
            'order_date' => Carbon::now()->subHours(2),
            'total_price' => 4900000,
            'note' => null,
            'payment_method' => 'CreditCard',
            'delivery_status' => 'Success',
        ]);
    }
}

