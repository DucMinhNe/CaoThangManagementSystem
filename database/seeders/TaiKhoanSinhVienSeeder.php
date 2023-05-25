<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaiKhoanSinhVien;
use Illuminate\Support\Facades\Hash;
class TaiKhoanSinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaiKhoanSinhVien::create([
            'tai_khoan' => 'sv1',
            'mat_khau' => '123',
            'id_sinh_vien' => 1,
        ]);
    }
}
