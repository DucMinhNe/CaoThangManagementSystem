<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ChucVuSinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chuc_vu_sinh_viens')->insert([
            [
                'id' => '1',
                'ten_chuc_vu' => 'Lớp trưởng',
            ],
            [
                'id' => '2',
                'ten_chuc_vu' => 'Lớp phó 1',
            ],
            [
                'id' => '3',
                'ten_chuc_vu' => 'Lớp phó 2',
            ],
            [
                'id' => '4',
                'ten_chuc_vu' => 'Bí thư',
            ],
            [
                'id' => '5',
                'ten_chuc_vu' => 'Phó bí thư',
            ],
            [
                'id' => '6',
                'ten_chuc_vu' => 'Thủ quỹ',
            ],
        ]);
    }
}