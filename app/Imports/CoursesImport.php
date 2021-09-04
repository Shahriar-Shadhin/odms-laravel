<?php

namespace App\Imports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class CoursesImport implements ToModel,WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Course([
            'course_code' => $row['code'],
            'course_name' => $row['name'],
            'course_dept' => $row['dept'],
            'course_semester' => $row['semester'],
            'class_number' => $row['classes'],
            'course_credit' => $row['credit']
        ]);
    }
}
