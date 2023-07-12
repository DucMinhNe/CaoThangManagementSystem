<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $this->call([
        //    ChucVuSinhVienSeeder::class,
           ChucVuGiangVienSeeder::class,
           GiangVienSeeder::class,
            KhoaSeeder::class,
          ChuyenNganhSeeder::class,
            LoaiMonHocSeeder::class,
           BoMonSeeder::class,
           MonHocSeeder::class,
          LopHocSeeder::class,
          SinhVienSeeder::class,
            ChuongTrinhDaoTaoSeeder::class,
           CTChuongTrinhDaoTaoSeeder::class,
        ]);
    }
}