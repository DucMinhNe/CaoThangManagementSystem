<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaiKhoanGiangVien;
use Illuminate\Support\Facades\Hash;
class TaiKhoanGiangVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaiKhoanGiangVien::create([
            'tai_khoan' => 'test',
            'mat_khau' => Hash::make('123'),
            'id_giang_vien' => 1,
        ]);

        // Thêm các dữ liệu tài khoản giảng viên khác nếu cần
    }
}
