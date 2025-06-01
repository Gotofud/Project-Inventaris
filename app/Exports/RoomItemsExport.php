<?php
namespace App\Exports;

use App\Models\Room_Items;
use App\Models\Room;
use App\Models\mainDatas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class RoomItemsExport implements FromCollection, WithHeadings, WithEvents
{
    protected $data;

    public function collection()
    {
        // Ambil data beserta relasi ruangan dan item
        $this->data = Room_Items::with(['room', 'mainData'])
            ->orderBy('rooms_id')
            ->get()
            ->map(function ($item) {
                return [
                    'room'         => $item->room->room_name ?? '-',
                    'item'         => $item->mainData->name ?? '-',
                    'total_amount' => $item->amount,
                ];
            });

        return $this->data;
    }

    public function headings(): array
    {
        return ['Room', 'Item', 'Total Amount'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $data = $this->data;
                $currentRow = 2; // Mulai dari baris kedua (setelah heading)
                $roomCounts = [];

                // Hitung jumlah data per ruangan
                foreach ($data as $row) {
                    $room = $row['room'];
                    if (!isset($roomCounts[$room])) {
                        $roomCounts[$room] = 0;
                    }
                    $roomCounts[$room]++;
                }

                // Merge cell untuk setiap ruangan
                foreach ($roomCounts as $room => $count) {
                    if ($count > 1) {
                        $startRow = $currentRow;
                        $endRow = $currentRow + $count - 1;
                        $event->sheet->mergeCells("A{$startRow}:A{$endRow}");
                    }
                    $currentRow += $count;
                }
                
                  $lastColumn = $event->sheet->getHighestColumn();
                $lastRow = $event->sheet->getHighestRow();

                // Style heading
                $event->sheet->getDelegate()->getStyle("A1:{$lastColumn}1")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '0D1B39', // warna biru gelap
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Border seluruh tabel
                $event->sheet->getDelegate()->getStyle("A1:{$lastColumn}{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Auto size kolom
                foreach (range('A', $lastColumn) as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}


