<?php

namespace App\Imports;

use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FirstSheetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            Teacher::query()->create([
                'full_name' => $row['teacher'],
                'city' => $row['city'],
                'university' => $row['university'],
                'url' => $row['url'],
                'country' => 'Canada',
                'field' => $row['field'],
                'situation' => $row['situation'],
                'final' => $row['final'],
                'sent' => $row['send_email'],
                'start_date' => $row['first_date'] !== null ? Carbon::createFromTimestamp(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($row['first_date'])) : null,
                'first_reminder' => $row['remind_1'] !== null ? Carbon::createFromTimestamp(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($row['remind_1'])) : null,
                'second_reminder' => $row['remind_2'] !== null ? Carbon::createFromTimestamp(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($row['remind_2'])) : null,
                'third_reminder' => $row['remind_3'] !== null ? Carbon::createFromTimestamp(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($row['remind_3'])) : null,
                'email' => $row['email'],
            ]);
        }
    }
}
