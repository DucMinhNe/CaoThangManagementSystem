<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Hash;
class GiangVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('giang_viens')->insert([
            [
                'ma_gv' => '046123001',
                'ten_giang_vien' => 'Nguyễn Văn Chiến',
                'email' => 'chiennv@ut.edu.vn',
                'so_dien_thoai' => '0906913419',
                'so_cmt' => '123456789',
                'ngay_sinh' => '1989-03-27',
                'noi_sinh' => 'HCM',
                'gioi_tinh' => true,
                'dan_toc' => 'Kinh',
                'ton_giao' => 'Không',
                'dia_chi_thuong_tru' => 'HCM',
                'dia_chi_tam_tru' => 'HCM',
                'tai_khoan' => 'chiennv@ut.edu.vn',
                'mat_khau' => Hash::make('123456789'),
                'hinh_anh_dai_dien' => '046123001_1757523229.jpg',
                'id_chuc_vu' => 1,
                'id_bo_mon' => null,
                'tinh_trang_lam_viec' => 1,
                'trang_thai' => 1,
            ],
        ]);
    }
}