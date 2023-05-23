<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'mssv' => $row[0],
            'hoten' => $row[1],
            'lop' => $row[2],
            'email' => $row[3],
            'cmnd' => $row[4],
            'sdt' => $row[5],
            'ngaysinh' => $row[6],
            'gioitinh' => $row[7],
            'hinhdaidien' => $row[8],
            'trangthai' => $row[9]
        ]);
    }
}
