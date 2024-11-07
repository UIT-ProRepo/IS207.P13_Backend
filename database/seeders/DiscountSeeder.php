<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Discount;
use Carbon\Carbon;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Discount::create([
            'product_id' => 38,
            'is_percent' => true,
            'amount' => 10, // Giảm giá 10%
            'from_date' => Carbon::create(2024, 11, 7),
            'to_date' => Carbon::create(2024, 12, 7),
        ]);
        
        Discount::create([
            'product_id' => 63,
            'is_percent' => false,
            'amount' => 50000, // Giảm giá 50,000 VND
            'from_date' => Carbon::create(2024, 11, 8),
            'to_date' => Carbon::create(2024, 12, 8),
        ]);
        
        Discount::create([
            'product_id' => 11,
            'is_percent' => true,
            'amount' => 15, // Giảm giá 15%
            'from_date' => Carbon::create(2024, 11, 9),
            'to_date' => Carbon::create(2024, 12, 9),
        ]);
    }
}
