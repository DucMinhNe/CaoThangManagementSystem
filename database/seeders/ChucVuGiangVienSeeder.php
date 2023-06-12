<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ChucVuGiangVien;
class ChucVuGiangVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chuc_vu_giang_viens')->insert([
            [
                'id' => '1',
                'ten_chuc_vu' => 'Super Admin',
            ],
            [
                'id' => '2',
                'ten_chuc_vu' => 'Admin',
            ],
            [
                'id' => '3',
                'ten_chuc_vu' => 'Giảng Viên',
            ]
          
        ]);
    }
}