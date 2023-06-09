<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MonHoc;
class MonHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MonHoc::create([
            'id' => 1,
            'ten_mon_hoc' => 'Nhập Môn Lập Trình',
            'id_bo_mon' => '1',
            'id_loai_mon_hoc' => '1',
        ],[
            'id' => 2,
            'ten_mon_hoc' => 'Nhập Môn Lập Trình',
            'id_bo_mon' => '1',
            'id_loai_mon_hoc' => '1',
        ]);
    }
}
