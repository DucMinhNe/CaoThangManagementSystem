<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DanhSachChucVuGiangVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('danh_sach_chuc_vu_giang_viens')->insert([
            [
                'id' => '1',
                'ma_sv' => '',
                'id_chuc_vu ' => 1,
            ],
            [
                'id' => '2',
                'ma_sv' => '',
                'id_chuc_vu ' => 1,
            ],
            [
                'id' => '3',
                'ma_sv' => '',
                'id_chuc_vu ' => 1,
            ],
            [
                'id' => '4',
                'ma_sv' => '',
                'id_chuc_vu ' => 1,
            ],
            [
                'id' => '5',
                'ma_sv' => '',
                'id_chuc_vu ' => 1,
            ],
            [
                'id' => '6',
                'ma_sv' => '',
                'id_chuc_vu ' => 1,
            ],
        ]);
    }
}