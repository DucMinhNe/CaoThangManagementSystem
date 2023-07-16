<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Khoa;

class KhoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('khoas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ten_khoa' => 'Công Nghệ Thông Tin',
                'trang_thai' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'ten_khoa' => 'Cơ Khí',
                'trang_thai' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'ten_khoa' => 'Cơ Khí Động Lực',
                'trang_thai' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'ten_khoa' => 'Điện - Điện Tử',
                'trang_thai' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'ten_khoa' => 'Công Nghệ Nhiệt - Lạnh',
                'trang_thai' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'ten_khoa' => 'Giáo Dục Đại Cương',
                'trang_thai' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'ten_khoa' => 'Bộ Môn Kinh Tế',
                'trang_thai' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
}