<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GiangVien;
class GiangVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GiangVien::create([
            'ma_gv' => 'GV001',
            'ten_giang_vien' => 'Lê Đức Minh',
            'email' => 'ducminh@gmail.com',
            'so_dien_thoai' => '0123456789',
            'so_cmt' => '123456789',
            'ngay_sinh' => '2002-04-04',
            'noi_sinh' => 'HCM',
            'gioi_tinh' => true,
            'dan_toc' => 'Kinh',
            'ton_giao' => 'Không',
            'dia_chi_thuong_tru' => 'HCM',
            'dia_chi_tam_tru' => 'HCM',
            'id_bo_mon' => null,
            'quoc_gia' => 'Việt Nam',
            'hinh_anh_dai_dien' => 'avatar.png',
            'id_chuc_vu' => null,
            'id_chuc_vu' => null,
            'trang_thai_lam_viec' => 1,
            'trang_thai' => 1,
        ]);
    }
}
