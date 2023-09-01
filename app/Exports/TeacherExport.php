<?php

namespace App\Exports;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TeacherExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    use Exportable;

    public function query()
    {
        return Teacher::query();
    }

    public function headings(): array
    {
        return [
            '#',
            'Full Name',
            'University',
            'Country',
            'City',
            'Field',
            'Email',
            'Url',
            'Sent',
            'Start date',
            'First reminder',
            'Second reminder',
            'Third reminder',
            'Situation',
            'Final',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->full_name,
            $row->university,
            $row->country,
            $row->city,
            $row->field,
            $row->email,
            $row->url,
            $row->sent,
            Date::stringToExcel($row->start_date),
            Date::stringToExcel($row->first_reminder),
            Date::stringToExcel($row->second_reminder),
            Date::stringToExcel($row->third_reminder),
            $row->situation,
            $row->final,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'J' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'K' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'L' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'M' => NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->getStyle('A:M')->getAlignment()->setHorizontal('center');
    }

}
