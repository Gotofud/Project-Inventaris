<?php
namespace App\Exports;

use App\Models\Category;
use Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Category::get()->map(function ($item) {
            return [
                'id' => $item->id,
                'category_name' => $item->category_name,
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Category Name'];
    }
}


