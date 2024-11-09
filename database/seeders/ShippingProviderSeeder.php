<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingProvider;

class ShippingProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Thêm các đơn vị vận chuyển mẫu với thông tin liên hệ
        $providers = [
            [
                'name' => 'Giao hàng tiết kiệm',
            ],
            [
                'name' => 'Giao hàng nhanh',
            ],
            [
                'name' => 'J&T Express',
            ],
            [
                'name' => 'Aha Move',
            ],
        ];

        foreach ($providers as $provider) {
            ShippingProvider::create($provider);
        }
    }
}
