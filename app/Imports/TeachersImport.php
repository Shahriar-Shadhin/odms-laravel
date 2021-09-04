<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class TeachersImport implements ToModel,WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Teacher([
            'teacher_name' => $row['name'],
            'teacher_username' => $row['username'],
            'teacher_password' => Hash::make($row['username']),
            'teacher_dept' => $row['dept'],
            'teacher_phone' => $row['phone'],
            'teacher_email' => $row['email']
        ]);
    }
}
