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
                'ma_sv' => '2331122006',
                'ten_sinh_vien' => 'Nguyễn Văn Thoại',
                'email' => '0306201123@gmail.com',
                'so_dien_thoai' => '0906913419',
                'so_cmt' => '215587193',
                'gioi_tinh' => true,
                'ngay_sinh' => '2002-04-04',
                'noi_sinh' => 'TP.HCM',
                'dan_toc' => 'Kinh',
                'ton_giao' => 'Không',
                'dia_chi_thuong_tru' => '479 tỉnh lộ 15, ấp 7, xã tân thạnh đông, huyện củ chi',
                'dia_chi_tam_tru' => '479 tỉnh lộ 15, ấp 7, xã tân thạnh đông, huyện củ chi',
                'hinh_anh_dai_dien' => '2331122006_1757522534.jpg',
                'tai_khoan' => 'test',
                'mat_khau' => Hash::make('123'),
                'khoa_hoc' => '2020',
                'bac_dao_tao' => 'Đại Học',
                'he_dao_tao' => 'Chính quy',
                'id_lop_hoc' => 1,
                 'tinh_trang_hoc' => 'Đang học',
            ],
        ]);
    }
}