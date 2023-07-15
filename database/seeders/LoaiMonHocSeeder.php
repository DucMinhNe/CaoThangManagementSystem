<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\LoaiMonHoc;
class LoaiMonHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loai_mon_hocs')->insert([
            [
                'id' => '1',
                'ten_loai_mon_hoc' => 'Lý Thuyết',
            ],
            [
                'id' => '2',
                'ten_loai_mon_hoc' => 'Thực Hành',
            ],
            [
                'id' => '3',
                'ten_loai_mon_hoc' => 'Đồ Án',
            ],
        ]);
    }
}