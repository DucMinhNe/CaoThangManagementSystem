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
                'ten_lop_hoc' => 'CN23SG1',
                'id_chuyen_nganh' => 5,
                'ma_gv_chu_nhiem' => null,
            ],
            [
                'id' => '2',
                'ten_lop_hoc' => 'CN23SG2',
                'id_chuyen_nganh' => 5,
                'ma_gv_chu_nhiem' => null,
            ],
            [
                'id' => '3',
                'ten_lop_hoc' => 'CN23SG3',
                'id_chuyen_nganh' => 5,
                'ma_gv_chu_nhiem' => null,
            ],
            [
                'id' => '4',
                'ten_lop_hoc' => 'CN23SG4',
                'id_chuyen_nganh' => 5,
                'ma_gv_chu_nhiem' => null,
            ],
        ]);
    }
}