<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ChuyenNganh;
class ChuyenNganhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chuyen_nganhs')->insert([
            [
                'id' => '1',
                'ten_chuyen_nganh' => 'Công nghệ Kỹ thuật Cơ khí',
                'ma_chu' => 'CK',
                'ma_so' => '01',
                'id_khoa' => '2',
            ],
            [
                'id' => '2',
                'ten_chuyen_nganh' => 'Công nghệ Kỹ thuật Ô tô',
                'ma_chu' => 'OTO',
                'ma_so' => '02',
                'id_khoa' => '3',
            ],
            [
                'id' => '3',
                'ten_chuyen_nganh' => 'Công nghệ Kỹ thuật Điện-Điện tử',
                'ma_chu' => 'Đ-ĐT',
                'ma_so' => '03',
                'id_khoa' => '4',
            ],
            [
                'id' => '4',
                'ten_chuyen_nganh' => 'Công nghệ Kỹ thuật Nhiệt lạnh',
                'ma_chu' => 'NL',
                'ma_so' => '04',
                'id_khoa' => '2',
            ],
            [
                'id' => '5',
                'ten_chuyen_nganh' => 'Công nghệ Thông tin',
                'ma_chu' => 'TH',
                'ma_so' => '06',
                'id_khoa' => '1',
            ]
        ]);
    }
}
