<?php

namespace App\Exports;

use App\Models\PartnerEnquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DealerEnquiriesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return PartnerEnquiry::where('partner_id', 1)->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Firm Name',
            'GST',
            'Pincode',
            'Occupation',
            'Experience',
            'Dealership Type',
            'Description',
            'Created At'
        ];
    }

    public function map($dealer): array
    {
        return [
            $dealer->name,
            $dealer->email,
            $dealer->phone,
            $dealer->firm_name,
            $dealer->gst,
            $dealer->pincode,
            $dealer->occupation,
            $dealer->experience,
            $dealer->dealership_type,
            $dealer->description,
            $dealer->created_at ? date('Y-m-d H:i:s', strtotime($dealer->created_at)) : ''
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
