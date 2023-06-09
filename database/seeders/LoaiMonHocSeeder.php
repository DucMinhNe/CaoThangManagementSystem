<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\LoaiMonHoc;
class LoaiMonHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('khoas')->insert([
            [
                'id' => '1',
                'ten_khoa' => 'Công Nghệ Thông Tin',
            ],
            [
                'id' => '2',
                'ten_khoa' => 'Cơ Khí',
            ],
            [
                'id' => '3',
                'ten_khoa' => 'Cơ Khí Động Lực',
            ],
            [
                'id' => '4',
                'ten_khoa' => 'Điện - Điện Tử',
            ],
            [
                'id' => '5',
                'ten_khoa' => 'Công Nghệ Nhiệt - Lạnh',
            ],
            [
                'id' => '6',
                'ten_khoa' => 'Giáo Dục Đại Cương',
            ],
            [
                'id' => '7',
                'ten_khoa' => 'Bộ Môn Kinh Tế',
            ]
        ]);
    }
}
