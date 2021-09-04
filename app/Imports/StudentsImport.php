<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class StudentsImport implements ToModel,WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'student_id' => $row['id'],
            'student_name' => $row['name'],
            'student_username' => $row['id'],
            'student_dept' => $row['dept'],
            'student_session' => $row['session'],
            'student_semester' => $row['semester'],
            'student_email' => $row['email'],
            'student_password' => Hash::make($row['id'])
        ]);
    }
}
