<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'Admin',
                'desc' => 'Quản trị viên',
            ],
            [
                'role_name' => 'CTV',
                'desc' => 'Cộng tác viên',
            ]
        ]);
    }
}
