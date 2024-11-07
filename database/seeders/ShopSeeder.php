<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Shop;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Shop::create([
            'id' => '1',
            'owner_id' => '11',
            'address_id' => '19',
            'name' => 'Nội thất Nhà Xinh CS1',
            'phone' => '0906904114',
            'is_alive' => true,
        ]);
        Shop::create([
            'id' => '2',
            'owner_id' => '12',
            'address_id' => '21',
            'name' => 'Nội thất Nhà Xinh CS2',
            'phone' => '0899150045',
            'is_alive' => true,
        ]);
        Shop::create([
            'id' => '3',
            'owner_id' => '15',
            'address_id' => '25',
            'name' => 'Nội thất Nhà Xinh CS3',
            'phone' => '0908787393',
            'is_alive' => true,
        ]);
        Shop::create([
            'id' => '4',
            'owner_id' => '18',
            'address_id' => '32',
            'name' => 'Nội thất Nhà Xinh CS4',
            'phone' => '0908181393',
            'is_alive' => false,
        ]);
    }
}
