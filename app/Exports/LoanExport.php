<?php
namespace App\Exports;

use App\Models\loanData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LoanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return loanData::get()->map(function ($item) {
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
}


