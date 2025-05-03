<?php

namespace App\Exports;

use App\Models\MainDatas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MainDataExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return MainDatas::all(['prd_code', 'name', 'category', 'stock','created_at']);
    }

    public function headings(): array
    {
        return ['Production Code', 'Item Name', 'Category', 'Stock', 'Created At'];
    }
}
