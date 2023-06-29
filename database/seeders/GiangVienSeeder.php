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
                'ma_gv' => '123',
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
                'tai_khoan' => 'test',
                'mat_khau' => Hash::make('123'),
                'hinh_anh_dai_dien' => '123.jpg',
                'id_chuc_vu' => 1,
                'id_bo_mon' => null,
                'tinh_trang_lam_viec' => 1,
                'trang_thai' => 1,
            ],
            [
                'ma_gv' => '1234',
                'ten_giang_vien' => 'Lê Viết Hoàng Nguyên',
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
                'tai_khoan' => 'test2',
                'mat_khau' => Hash::make('123'),
                'hinh_anh_dai_dien' => '1234.jpg',
                'id_chuc_vu' => 2,
                'id_bo_mon' => null,
                'tinh_trang_lam_viec' => 1,
                'trang_thai' => 1,
            ],
            [
                'ma_gv' => '12345',
                'ten_giang_vien' => 'Lê Lê Lê',
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
                'tai_khoan' => 'test3',
                'mat_khau' => Hash::make('123'),
                'hinh_anh_dai_dien' => '12345.jpg',
                'id_chuc_vu' => 3,
                'id_bo_mon' => null,
                'tinh_trang_lam_viec' => 1,
                'trang_thai' => 1,
            ],
        ]);
    }
}