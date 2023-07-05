<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Hash;
class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sinh_viens')->insert([
            [
                'ma_sv' => '0306201123',
                'ten_sinh_vien' => 'Lê Văn A',
                'email' => 'ducminh@gmail.com',
                'so_dien_thoai' => '0123456789',
                'so_cmt' => '123456789',
                'gioi_tinh' => true,
                'ngay_sinh' => '2002-04-04',
                'noi_sinh' => 'HCM',
                'dan_toc' => 'Kinh',
                'ton_giao' => 'Không',
                'dia_chi_thuong_tru' => 'HCM',
                'dia_chi_tam_tru' => 'HCM',
                'hinh_anh_dai_dien' => '0306201123.jpg',
                'tai_khoan' => 'test',
                'mat_khau' => Hash::make('123'),
                'khoa_hoc' => '2020',
                'bac_dao_tao' => 'Cao đẳng ngành',
                'he_dao_tao' => 'Chính quy',
                'id_lop_hoc' => 1,
                'tinh_trang_hoc' => null,
            ],
            [
                'ma_sv' => '0306201124',
                'ten_sinh_vien' => 'Lê Văn B',
                'email' => 'ducminh@gmail.com',
                'so_dien_thoai' => '0123456789',
                'so_cmt' => '123456789',
                'gioi_tinh' => true,
                'ngay_sinh' => '2002-04-04',
                'noi_sinh' => 'HCM',
                'dan_toc' => 'Kinh',
                'ton_giao' => null,
                'dia_chi_thuong_tru' => 'HCM',
                'dia_chi_tam_tru' => 'HCM',
                'hinh_anh_dai_dien' => '0306201124.jpg',
                'tai_khoan' => 'test',
                'mat_khau' => Hash::make('123'),
                'khoa_hoc' => '2020',
                'bac_dao_tao' => 'Cao đẳng ngành',
                'he_dao_tao' => 'Chính quy',
                'id_lop_hoc' => 1,
                'tinh_trang_hoc' => null,
            ],
            [
                'ma_sv' => '0306201125',
                'ten_sinh_vien' => 'Lê Văn C',
                'email' => 'ducminh@gmail.com',
                'so_dien_thoai' => '0123456789',
                'so_cmt' => '123456789',
                'gioi_tinh' => true,
                'ngay_sinh' => '2002-04-04',
                'noi_sinh' => 'HCM',
                'dan_toc' => 'Kinh',
                'ton_giao' => null,
                'dia_chi_thuong_tru' => 'HCM',
                'dia_chi_tam_tru' => 'HCM',
                'hinh_anh_dai_dien' => '0306201125.jpg',
                'tai_khoan' => 'test',
                'mat_khau' => Hash::make('0308'),
                'khoa_hoc' => '2020',
                'bac_dao_tao' => 'Cao đẳng ngành',
                'he_dao_tao' => 'Chính quy',
                'id_lop_hoc' => 1,
                'tinh_trang_hoc' => null,
            ],
            [
                'ma_sv' => '0306201126',
                'ten_sinh_vien' => 'Lê Văn D',
                'email' => 'ducminh@gmail.com',
                'so_dien_thoai' => '0123456789',
                'so_cmt' => '123456789',
                'gioi_tinh' => true,
                'ngay_sinh' => '2002-04-04',
                'noi_sinh' => 'HCM',
                'dan_toc' => 'Kinh',
                'ton_giao' => null,
                'dia_chi_thuong_tru' => 'HCM',
                'dia_chi_tam_tru' => 'HCM',
                'hinh_anh_dai_dien' => '0306201126.jpg',
                'tai_khoan' => 'test',
                'mat_khau' => Hash::make('123'),
                'khoa_hoc' => '2020',
                'bac_dao_tao' => 'Cao đẳng ngành',
                'he_dao_tao' => 'Chính quy',
                'id_lop_hoc' => 1,
                'tinh_trang_hoc' => null,
            ],
        ]);
    }
}