<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class MonHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mon_hocs')->insert([
            [
                'id' => '1',
                'ten_mon_hoc' => 'Nhập Môn Lập Trình',
                'id_bo_mon' => '1',
                'id_loai_mon_hoc' => '1',
            ],
            [
                'id' => '2',
                'ten_mon_hoc' => 'Phần Cứng Máy Tính',
                'id_bo_mon' => '1',
                'id_loai_mon_hoc' => '1',
            ], [
                'id' => '3',
                'ten_mon_hoc' => 'Toán Cao Cấp',
                'id_bo_mon' => '3',
                'id_loai_mon_hoc' => '1',
            ], [
                'id' => '4',
                'ten_mon_hoc' => 'Vật Lý Đại Cương',
                'id_bo_mon' => '3',
                'id_loai_mon_hoc' => '1',
            ]
        ]);
    }
}