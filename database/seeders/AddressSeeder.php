<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;


class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::create([
            'province' => 'Hà Nội',
            'district' => 'Hoàn Kiếm',
            'ward' => 'Hàng Trống',
            'detail' => 'Số 1 Đinh Tiên Hoàng'
        ]);

        Address::create([
            'province' => 'Hồ Chí Minh',
            'district' => 'Quận 1',
            'ward' => 'Bến Nghé',
            'detail' => 'Số 2 Lê Duẩn'
        ]);

        Address::create([
            'province' => 'Đà Nẵng',
            'district' => 'Hải Châu',
            'ward' => 'Phước Ninh',
            'detail' => 'Số 10 Bạch Đằng',
        ]);

        Address::create([
            'province' => 'Cần Thơ',
            'district' => 'Ninh Kiều',
            'ward' => 'Tân An',
            'detail' => 'Số 5 Nguyễn Trãi',
        ]);

        Address::create([
            'province' => 'Hải Phòng',
            'district' => 'Ngô Quyền',
            'ward' => 'Máy Tơ',
            'detail' => 'Số 15 Lạch Tray',
        ]);

        Address::create([
            'province' => 'Nghệ An',
            'district' => 'Vinh',
            'ward' => 'Hưng Bình',
            'detail' => 'Số 3 Quang Trung',
        ]);

        Address::create([
            'province' => 'Quảng Ninh',
            'district' => 'Hạ Long',
            'ward' => 'Bạch Đằng',
            'detail' => 'Số 18 Lê Thánh Tông',
        ]);

        Address::create([
            'province' => 'Lâm Đồng',
            'district' => 'Đà Lạt',
            'ward' => 'Phường 3',
            'detail' => 'Số 20 Đinh Tiên Hoàng',
        ]);

        Address::create([
            'province' => 'Khánh Hòa',
            'district' => 'Nha Trang',
            'ward' => 'Lộc Thọ',
            'detail' => 'Số 8 Trần Phú',
        ]);

        Address::create([
            'province' => 'Bình Định',
            'district' => 'Quy Nhơn',
            'ward' => 'Nguyễn Văn Cừ',
            'detail' => 'Số 4 Nguyễn Huệ',
        ]);

        Address::create([
            'province' => 'Phú Yên',
            'district' => 'Tuy Hòa',
            'ward' => 'Phường 7',
            'detail' => 'Số 7 Lê Lợi',
        ]);

        Address::create([
            'province' => 'Quảng Nam',
            'district' => 'Hội An',
            'ward' => 'Minh An',
            'detail' => 'Số 1 Bạch Đằng',
        ]);

        Address::create([
            'province' => 'Thừa Thiên Huế',
            'district' => 'Huế',
            'ward' => 'Thuận Thành',
            'detail' => 'Số 10 Lê Lợi',
        ]);
    }
}