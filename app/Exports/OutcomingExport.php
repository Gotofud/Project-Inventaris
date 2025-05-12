<?php
namespace App\Exports;

use App\Models\outcomingItems;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OutcomingExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return OutcomingItems::get()->map(function ($item) {
            return [
                'out_code' => $item->out_code,
                'name' => $item->mainData->name,
                'category' => $item->mainData->category->category_name,
                'amount' => $item->amount,
                'info' => $item->info,
                'exit_date' => $item->exit_date,
            ];
        });
    }

    public function headings(): array
    {
        return ['Outcoming Code', 'Item Name', 'Category', 'Amount', 'Info', 'Exit At'];
    }
}


