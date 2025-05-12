<?php
namespace App\Exports;

use App\Models\User;
use Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StaffExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::get()->map(function ($item) {
            return [
                'name' => $item->name,
                'email' => $item->email,
                'is_admin' => $item->is_admin === 0 ? 'Admin' : 'Staff',
            ];
        });
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Role'];
    }
}


