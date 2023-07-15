<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LopHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lop_hocs')->insert([
            [
                'id' => '1',
                'ten_lop_hoc' => 'CĐ TH 20B',
                'id_chuyen_nganh' => 5,
                'ma_gv_chu_nhiem' => null,
            ],
            [
                'id' => '2',
                'ten_lop_hoc' => 'CĐ TH 21A',
                'id_chuyen_nganh' => 5,
                'ma_gv_chu_nhiem' => null,
            ],
            [
                'id' => '3',
                'ten_lop_hoc' => 'CĐ TH 22C',
                'id_chuyen_nganh' => 5,
                'ma_gv_chu_nhiem' => null,
            ],
            [
                'id' => '4',
                'ten_lop_hoc' => 'CĐ TH 23D',
                'id_chuyen_nganh' => 5,
                'ma_gv_chu_nhiem' => null,
            ],
        ]);
    }
}