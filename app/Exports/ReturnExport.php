<?php
namespace App\Exports;

use App\Models\loanData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ReturnExport implements FromCollection, WithHeadings, WithEvents
{
    public function collection()
    {
        return loanData::where('status',1)->get()->map(function ($item) {
                return [
                'loan_code' => $item->loan_code,
                'brws_name' => $item->brws_name,
                'name' => $item->mainData->name,
                'category' => $item->mainData->category->category_name,
                'amount' => $item->amount,
                'status' => $item->status === 0 ? 'Not Return' : 'Returned' ,
                'info' => $item->info,
                'loan_date' => $item->loan_date,
            ];  
        });
    }

    public function headings(): array
    {
        return ['Loan Code', 'Borrower','Item', 'Category', 'Amount','Status', 'Info', 'Loan At'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:H1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'FFFFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FF0000FF',
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $lastColumn = $event->sheet->getHighestColumn();
                $lastRow = $event->sheet->getHighestRow();

                $event->sheet->getDelegate()->getStyle("A1:{$lastColumn}{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                foreach (range('A', $lastColumn) as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}


