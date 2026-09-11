<?php

namespace App\Exports;

use App\Models\ProductInquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductInquiriesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return ProductInquiry::with('product')->get();
    }

    public function headings(): array
    {
        return [
            'Product',
            'Brochure Type',
            'Name',
            'Email',
            'Mobile',
            'Pincode',
            'Created At',
        ];
    }

    public function map($inquiry): array
    {
        return [
            $inquiry->product?->title ?? 'N/A',
            $inquiry->brochure_type ?? 'N/A',
            $inquiry->name,
            $inquiry->email ?? 'N/A',
            $inquiry->mobile,
            $inquiry->pincode,
            $inquiry->created_at
                ? $inquiry->created_at->format('Y-m-d H:i:s')
                : '',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'E2EFDA',
                    ],
                ],
            ],
        ];
    }
}
