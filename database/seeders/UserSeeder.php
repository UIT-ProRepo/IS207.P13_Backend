<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Tạo dữ liệu mẫu cho role admin
         */
        for ($i = 0; $i < 10; ++$i)  {            
            DB::table('users')->insert([
                'full_name' => '[seed] admin ' . $i,
                'email' => 'admin' . $i . '@gmail.com',
                'hashed_password' => Hash::make('123456'),
                'phone' => '000000000'. $i,
                'gender' => 'other',
                'date_of_birth' => '2004-01-01',
                'role' => 'admin',
            ]);
        }

        /**
         * Tạo dữ liệu mẫu cho role owner
         */
        for ($i = 0; $i < 10; ++$i)  {            
            DB::table('users')->insert([
                'full_name' => '[seed] owner ' . $i,
                'email' => 'owner' . $i . '@gmail.com',
                'hashed_password' => Hash::make('123456'),
                'phone' => '100000000'. $i,
                'gender' => 'other',
                'date_of_birth' => '2004-01-01',
                'role' => 'owner',
            ]);
        }
        
        /**
         * Tạo dữ liệu mẫu cho role customer
         */
        for ($i = 0; $i < 10; ++$i)  {            
            DB::table('users')->insert([
                'full_name' => '[seed] customer ' . $i,
                'email' => 'customer' . $i . '@gmail.com',
                'hashed_password' => Hash::make('123456'),
                'phone' => '200000000'. $i,
                'gender' => 'other',
                'date_of_birth' => '2004-01-01',
                'role' => 'customer',
            ]);
        }
    }
}
