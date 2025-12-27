<?php

namespace App\Exports;

use App\Models\PrivateProjectEnquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PrivateProjectEnquiriesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return PrivateProjectEnquiry::all();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Project Name/Company',
            'Phone',
            'Created At'
        ];
    }

    public function map($enquiry): array
    {
        return [
            $enquiry->name,
            $enquiry->project_name ?? 'N/A',
            $enquiry->phone,
            $enquiry->created_at ? date('Y-m-d H:i:s', strtotime($enquiry->created_at)) : ''
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
