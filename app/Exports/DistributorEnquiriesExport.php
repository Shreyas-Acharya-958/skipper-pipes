<?php

namespace App\Exports;

use App\Models\PartnerEnquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DistributorEnquiriesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return PartnerEnquiry::where('partner_id', 2)->get();
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

    public function map($distributor): array
    {
        return [
            $distributor->name,
            $distributor->email,
            $distributor->phone,
            $distributor->firm_name,
            $distributor->gst,
            $distributor->pincode,
            $distributor->occupation,
            $distributor->experience,
            $distributor->dealership_type,
            $distributor->description,
            $distributor->created_at ? date('Y-m-d H:i:s', strtotime($distributor->created_at)) : ''
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
