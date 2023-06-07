<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Models\GiangVien;
use App\Models\TaiKhoanGiangVien;
use App\Models\SinhVien;
use App\Models\TaiKhoanSinhVien;
use App\Models\Khoa;
use App\Models\ChuyenNganh;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
           UserSeeder::class,
           GiangVienSeeder::class,
           TaiKhoanGiangVienSeeder::class,
           //SinhVienSeeder::class,
           //TaiKhoanSinhVienSeeder::class,
          // KhoaSeeder::class,
         //  ChuyenNganhSeeder::class,
        ]);
    }
}
