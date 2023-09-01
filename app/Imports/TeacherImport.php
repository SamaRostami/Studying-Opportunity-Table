<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TeacherImport implements ToModel, WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Teacher([
            //
        ]);
    }

    public function sheets(): array
    {
        return [
            0 => new FirstSheetImport(),
            1 => new SecondSheetImport(),
        ];
    }
}
