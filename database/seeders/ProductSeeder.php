<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Product::create([
            'id' => '11',
            'shop_id' => '1',
            'category_id' => '1',
            'name' => 'Giường Miami',
            'unit_price' => '19300001',
            'description' => 'Giường Miami 1m6: Đắm mình trong giấc ngủ sâu nhờ thiết kế êm ái, vững chắc. Chất liệu tự nhiên thân thiện với môi trường, mang đến không gian sống lành mạnh.',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2024/03/giuong-miami-1m6-vai-vadela165.jpg',
            'is_deleted' => false,
            'quantity' => '5',
        ]);
        Product::create([
            'id' => '23',
            'shop_id' => '3',
            'category_id' => '2',
            'name' => 'Kệ Sách Line',
            'unit_price' => '27690000',
            'description' => 'Kệ sách Line: Tạo điểm nhấn hiện đại cho không gian với kệ sách Line màu trắng tinh tế, thiết kế tối giản, giúp bạn sắp xếp sách và đồ vật gọn gàng.',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2022/12/KE-SACH-LINE-MAU-BRONZE-1.jpg',
            'is_deleted' => false,
            'quantity' => '8',
        ]);
        Product::create([
            'id' => '36',
            'shop_id' => '2',
            'category_id' => '3',
            'name' => 'Sofa 2 chỗ Hà Nội',
            'unit_price' => '15900000',
            'description' => 'Sofa 2 chỗ Hà Nội: Mang đến sự ấm cúng và thoải mái cho phòng khách với sofa 2 chỗ Hà Nội, thiết kế tinh tế, chất liệu cao cấp, phù hợp với nhiều không gian sống.',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2024/07/sofa-2-cho-ha-noi-1.jpg',
            'is_deleted' => false,
            'quantity' => '9',
        ]);
        Product::create([
            'id' => '48',
            'shop_id' => '1',
            'category_id' => '4',
            'name' => 'Bàn làm việc Fence',
            'unit_price' => '30900000',
            'description' => 'Bàn làm việc Fence: Nâng cao hiệu quả làm việc tại nhà với bàn làm việc Fence, thiết kế thông minh, đa năng, giúp bạn có một không gian làm việc chuyên nghiệp ngay tại nhà.',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2023/08/Ban-lam-viec-Fence-129-70-30.jpg',
            'is_deleted' => false,
            'quantity' => '2',
        ]);
        Product::create([
            'id' => '57',
            'shop_id' => '2',
            'category_id' => '5',
            'name' => 'Đôn Textile Ochre',
            'unit_price' => '5820000',
            'description' => 'Đôn Textile Ochre: Tăng thêm vẻ đẹp và tiện ích cho không gian sống với đôn Textile Ochre, thiết kế độc đáo, màu sắc tươi tắn, có thể kết hợp với nhiều kiểu nội thất khác nhau.',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2024/11/don-textile-ochre.jpg',
            'is_deleted' => false,
            'quantity' => '6',
        ]);
        Product::create([
            'id' => '63',
            'shop_id' => '3',
            'category_id' => '6',
            'name' => 'Bếp Vivo mẫu 2',
            'unit_price' => '83837455',
            'description' => 'Bếp Vivo mẫu 2: Nâng cấp không gian bếp với bếp Vivo mẫu 2, thiết kế hiện đại, đa chức năng, giúp bạn nấu nướng nhanh chóng và tiện lợi hơn.',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2021/10/bep_vivo_mau_2-13.jpg',
            'is_deleted' => false,
            'quantity' => '7',
        ]);
        Product::create([
            'id' => '72',
            'shop_id' => '3',
            'category_id' => '7',
            'name' => 'Chim Hạc trang trí',
            'unit_price' => '10080000',
            'description' => 'Chim Hạc trang trí: Mang đến không gian sống thêm phần sinh động và ý nghĩa với chim Hạc trang trí, biểu tượng của sự trường thọ và may mắn, làm đẹp cho mọi góc phòng.',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2023/04/CHIM-HAC-DECO-FLAMINGO-h66-63948K.jpg',
            'is_deleted' => false,
            'quantity' => '3',
        ]);
        Product::create([
            'id' => '86',
            'shop_id' => '2',
            'category_id' => '8',
            'name' => 'Ghế dài 3 chỗ',
            'unit_price' => '5740000',
            'description' => 'Ghế dài 3 chỗ: Thư giãn thoải mái với ghế dài 3 chỗ, thiết kế êm ái, rộng rãi, là nơi lý tưởng để đọc sách, xem phim hoặc trò chuyện cùng gia đình.',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2021/10/80846-1000-nhaxinh-hang-ngoai-troi-ghe.jpg',
            'is_deleted' => false,
            'quantity' => '11',
        ]);
        Product::create([
            'id' => '91',
            'shop_id' => '1',
            'category_id' => '9',
            'name' => 'Tủ tivi Valente',
            'unit_price' => '27900000',
            'description' => 'Tủ tivi Valente: Kiệt tác nội thất, kết hợp hoàn hảo giữa gỗ tự nhiên và thiết kế hiện đại, tôn lên vẻ đẹp sang trọng cho không gian phòng khách.',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2024/07/tu-ti-vi-valente-2.jpg',
            'is_deleted' => false,
            'quantity' => '10',
        ]);
        Product::create([
            'id' => '45',
            'shop_id' => '2',
            'category_id' => '4',
            'name' => 'Bàn nước Bridge',
            'unit_price' => '29900000',
            'description' => 'Bàn nước Bridge: Thiết kế độc đáo bằng gỗ sồi nguyên khối, kiểu dáng Bắc Âu, tinh xảo từng chi tiết, mang đến vẻ đẹp mộc mạc và sang trọng.',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2021/10/73863-6.jpg',
            'is_deleted' => false,
            'quantity' => '8',
        ]);
        Product::create([
            'id' => '38',
            'shop_id' => '1',
            'category_id' => '3',
            'name' => 'Sofa Bridge 3 chỗ',
            'unit_price' => '115000001',
            'description' => 'Sofa Bridge 3 chỗ: Sự kết hợp hoàn hảo giữa gỗ sồi Mỹ tự nhiên và da cao cấp, mang đến một sản phẩm vừa bền bỉ vừa sang trọng.',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2024/06/Sofa-Bridge-3-cho-da-cognac.jpg',
            'is_deleted' => false,
            'quantity' => '6',
        ]);
        Product::create([
            'id' => '96',
            'shop_id' => '2',
            'category_id' => '9',
            'name' => 'Tủ tivi Roma',
            'unit_price' => '7500001',
            'description' => 'Tủ tivi Roma hiện đại với tông màu trắng cùng chân gỗ tần bì tự nhiên, được gia công tỉ mỉ từng góc cạnh. Bạn nên kết hợp cùng bộ sưu tập Roma để căn phòng được hoàn hảo hơn.',
            'image_url' => 'https://nhaxinh.com/wp-content/uploads/2021/10/tu-tivi-roma.jpg',
            'is_deleted' => true,
            'quantity' => '3',
        ]);
    }
}
