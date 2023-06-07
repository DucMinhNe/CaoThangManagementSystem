<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChuyenNganh;
class ChuyenNganhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChuyenNganh::create([
            'ten_chuyen_nganh' => 'CNTT',
            'id_khoa' => 1,
        ]);
    }
}