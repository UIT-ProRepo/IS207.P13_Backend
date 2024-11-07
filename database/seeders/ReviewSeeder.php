<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Review::create([
            'user_id' => 21,
            'product_id' => 11,
            'comment' => 'Giường rất chắc chắn và đẹp, rất đáng tiền!',
            'rating' => 5,
            'is_approved' => true,
        ]);
        
        Review::create([
            'user_id' => 25,
            'product_id' => 23,
            'comment' => 'Kệ sách thiết kế đẹp, nhưng giá hơi cao.',
            'rating' => 4,
            'is_approved' => true,
        ]);
        
        Review::create([
            'user_id' => 23,
            'product_id' => 36,
            'comment' => 'Sofa ngồi rất thoải mái, chất liệu tốt.',
            'rating' => 5,
            'is_approved' => true,
        ]);
        
        Review::create([
            'user_id' => 29,
            'product_id' => 48,
            'comment' => 'Bàn làm việc tốt, nhưng giao hàng hơi chậm.',
            'rating' => 3,
            'is_approved' => false, // Đánh giá chưa được duyệt
        ]);
        
        Review::create([
            'user_id' => 30,
            'product_id' => 57,
            'comment' => 'Đôn Textile có màu sắc rất đẹp, phù hợp với không gian.',
            'rating' => 4,
            'is_approved' => true,
        ]);
    }
}
