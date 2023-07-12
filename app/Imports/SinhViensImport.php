<?php

namespace App\Imports;

use App\Models\SinhVien;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;
class SinhViensImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function headingRow(): int
    {
        return 4; // Số thứ tự của heading row (dòng tiêu đề)
    }
    private $idLopHocExcel;
    
    public function __construct($idLopHocExcel)
    {
        $this->idLopHocExcel = $idLopHocExcel;
    }
    public function model(array $row)
    {
        $gioiTinh = strtolower($row['gioi_tinh']);

    if ($gioiTinh === 'nam') {
        $gioiTinh = 1;
    } elseif ($gioiTinh === 'nữ') {
        $gioiTinh = 0;
    }
    
        return new SinhVien([
            'ma_sv' => $row['ma_sv'],
            'ten_sinh_vien' => $row['ten_sinh_vien'],
            'email' => $row['ma_sv'] . '@caothang.edu.vn',
            'so_dien_thoai' => $row['so_dien_thoai'],
            'so_cmt' => $row['so_cmt'],
            'gioi_tinh' => $gioiTinh,
            'ngay_sinh' => $row['ngay_sinh'],
            'noi_sinh' => $row['noi_sinh'],
            'dan_toc' => $row['dan_toc'],
            'ton_giao' => $row['ton_giao'],
            'dia_chi_thuong_tru' => $row['dia_chi_thuong_tru'],
            'dia_chi_tam_tru' => $row['dia_chi_tam_tru'],
            'tai_khoan' => $row['ma_sv'],
            'mat_khau' => Hash::make($row['so_cmt']),
            'khoa_hoc' => $row['khoa_hoc'],
            'bac_dao_tao' => $row['bac_dao_tao'],
            // 'he_dao_tao' => $row['he_dao_tao'],     
            'id_lop_hoc' => $this->idLopHocExcel,
        ]);
    }
} 