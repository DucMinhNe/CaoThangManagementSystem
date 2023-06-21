<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BoMonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bo_mons')->insert([
            [
                'id' => '1',
                'ten_bo_mon' => 'Công Nghệ Phần Mềm',
                'id_khoa' => '1',
            ],
            [
                'id' => '2',
                'ten_bo_mon' => 'Mạng Máy Tính',
                'id_khoa' => '1',
            ],
            [
                'id' => '3',
                'ten_bo_mon' => 'Văn Hóa Ngoại Ngữ',
                'id_khoa' => '6',
            ]
        ]);
    }
}