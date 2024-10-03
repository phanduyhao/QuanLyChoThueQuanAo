<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sử dụng Faker để tạo dữ liệu ngẫu nhiên
        $faker = Faker::create();

        // Tạo 10 bản ghi
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->phoneNumber,
                'password' => Hash::make('password123'), 
            ]);
        }
    }
}
