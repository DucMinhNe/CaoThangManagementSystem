<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CTChuongTrinhDaoTaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ct_chuong_trinh_dao_taos')->insert([
            [
                'id' => '1',
                'id_chuong_trinh_dao_tao' => 1,
                'hoc_ky' => 1,
                'id_mon_hoc' => 1,
                'so_tin_chi' => 3,
            ],
            [
                'id' => '2',
                'id_chuong_trinh_dao_tao' => 1,
                'hoc_ky' => 1,
                'id_mon_hoc' => 2,
                'so_tin_chi' => 3,
            ],
            [
                'id' => '3',
                'id_chuong_trinh_dao_tao' => 1,
                'hoc_ky' => 1,
                'id_mon_hoc' => 3,
                'so_tin_chi' => 5,
            ],
        ]);
    }
}