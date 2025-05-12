<?php
namespace App\Exports;

use App\Models\mainDatas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MainDataExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return mainDatas::with('category')->get()->map(function ($item) {
            return [
                'prd_code' => $item->prd_code,
                'name' => $item->name,
                'category' => $item->category->category_name ?? 'N/A',
                'stock' => $item->stock,
            ];
        });
    }

    public function headings(): array
    {
        return ['Product Code', 'Name', 'Category', 'Stock'];
    }
}


