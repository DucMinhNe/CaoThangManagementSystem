<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SinhVien;
class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SinhVien::create([
            'mssv' => '0306123123',
            'ho_ten' => 'Nguyen Van A',
            'ngay_sinh' => '2002-02-02',
            'noi_sinh' => 'HCM',
            'gioi_tinh' => true,
            'dan_toc' => 'Kinh',
            'so_cmt' => '123456789',
            'id_chuyen_nganh' => 1,
            'id_khoa' => 1,
            'ton_giao' => 'Khong',
            'email' => '0306123123@caothang.edu.vn',
            'so_dien_thoai' => '0123456789',
            'khoa_hoc' => 2023,
            'hinh_anh_dai_dien' => '0306123123.jpg',
            'bac_dao_tao' => 'Cao Đẳng',
            'he_dao_tao' => 'Chính Quy',
            'dia_chi_thuong_tru' => 'HCM',
            'dia_chi_tam_tru' => 'HCM',
            'quoc_gia' => 'Việt Nam',
            'id_lop_hoc' => '1',
            'tinh_trang_hoc' => 'Đang Học',
            'trang_thai' => 1,
        ]);
    }
}
