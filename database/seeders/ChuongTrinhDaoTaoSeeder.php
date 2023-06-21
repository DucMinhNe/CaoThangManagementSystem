<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ChuongTrinhDaoTaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chuong_trinh_dao_taos')->insert([
            [
                'id' => '1',
                'khoa_hoc' => '2020',
                'id_chuyen_nganh' => 5,
            ],
            [
                'id' => '2',
                'khoa_hoc' => '2021',
                'id_chuyen_nganh' => 5,
            ]
        ]);
    }
}