<?php

namespace App\Exports;

use App\Models\CareerApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CareerApplicationsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return CareerApplication::all();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Subject',
            'DOB',
            'Address',
            'Resume Download Link',
            'Created At'
        ];
    }

    public function map($career): array
    {
        $resumeLink = '';
        if ($career->resume_path) {
            $resumeLink = url('storage/' . $career->resume_path);
        }

        return [
            $career->name,
            $career->email,
            $career->phone,
            $career->subject,
            $career->dob ? date('Y-m-d', strtotime($career->dob)) : '',
            $career->address,
            $resumeLink,
            $career->created_at ? date('Y-m-d H:i:s', strtotime($career->created_at)) : ''
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E2EFDA']
                ]
            ]
        ];
    }
} 