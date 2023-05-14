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
            'magv' => 'GV001',
            'ten_gv' => 'Lê Đức Minh',
            'email' => 'ducminh@gmail.com',
            'sodienthoai' => '0123456789',
            'so_cmt' => '123456789',
            'ngaysinh' => '2002-04-04',
            'noisinh' => 'HCM',
            'gioitinh' => true,
            'dantoc' => 'Kinh',
            'tongiao' => 'Không',
            'dia_chi_thuong_tru' => 'HCM',
            'dia_chi_tam_tru' => 'HCM',
            'quoc_gia' => 'Việt Nam',
            'hinhanhdaidien' => 'avatar.png',
            'id_chuc_vu' => 1,
        ]);
    }
}
