<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([
            'id' => '1',
            'name' => 'Giường ngủ',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2021/11/GIUONG-MIAMI-1M8-VAI-DOLCE-094-3106032-2-768x430.jpg',
        ]);
        Category::create([
            'id' => '2',
            'name' => 'Kệ sách',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2022/12/KE-SACH-LINE-MAU-BRONZE-2.jpg',
        ]);
        Category::create([
            'id' => '3',
            'name' => 'Sofa',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2024/07/sofa-2-cho-ha-noi-4.jpg',
        ]);
        Category::create([
            'id' => '4',
            'name' => 'Bàn',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2023/08/Ban-lam-viec-Fence-129-70-30-9.jpg',
        ]);
        Category::create([
            'id' => '5',
            'name' => 'Ghế',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2024/11/don-textile-ochre-3.jpg',
        ]);
        Category::create([
            'id' => '6',
            'name' => 'Dụng cụ bếp',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2021/10/3-101512-2.jpg',
        ]);
        Category::create([
            'id' => '7',
            'name' => 'Hàng trang trí',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2023/04/CHIM-HAC-DECO-FLAMINGO-h66-63948K-6.jpg',
        ]);
        Category::create([
            'id' => '8',
            'name' => 'Ngoại thất',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2021/12/104765-ghe-ngoai-troi-sixties-red-orce-5.jpg',
        ]);
        Category::create([
            'id' => '9',
            'name' => 'Tủ',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2024/07/tu-ti-vi-valente-1-1-e1721639264504.jpg',
        ]);
    }
}
