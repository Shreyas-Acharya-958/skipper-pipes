<?php

namespace App\Exports;

use App\Models\BlogComment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BlogCommentsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return BlogComment::all();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Description',
            'Status',
            'Created At'
        ];
    }

    public function map($comment): array
    {
        return [
            $comment->name,
            $comment->email,
            $comment->description,
            $comment->status == 0 ? 'Pending' : 'Approved',
            $comment->created_at ? date('Y-m-d H:i:s', strtotime($comment->created_at)) : ''
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
