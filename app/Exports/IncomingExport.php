<?php
namespace App\Exports;

use App\Models\incomingItems;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IncomingExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return incomingItems::get()->map(function ($item) {
            return [
                'icm_code' => $item->icm_code,
                'name' => $item->mainData->name,
                'category' => $item->mainData->category->category_name,
                'amount' => $item->amount,
                'info' => $item->info,
                'entry_date' => $item->entry_date,
            ];
        });
    }

    public function headings(): array
    {
        return ['Incoming Code', 'Item Name', 'Category', 'Amount', 'Info', 'Coming At'];
    }
}


