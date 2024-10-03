<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Tạo 10 bản ghi
        for ($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'product_name' => $faker->word, // Faker không có 'product_name', thay bằng 'word'
                'cate_id' => 5, // Sử dụng số trực tiếp
                'size' => $faker->randomElement(['S', 'M', 'L', 'XL']), // Tạo kích cỡ ngẫu nhiên
                'image' => $faker->imageUrl(640, 480, 'products', true), // Tạo URL hình ảnh ngẫu nhiên
                'price_1_day' => $faker->randomFloat(2, 10, 100), // Tạo giá ngẫu nhiên từ 10 đến 100
                'quantity_origin' => $faker->numberBetween(1, 100), // Số lượng ngẫu nhiên
            ]);
        }
    }
}
