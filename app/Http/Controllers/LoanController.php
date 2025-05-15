<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\loanData;
use App\Models\mainDatas;
use App\Exports\LoanExport;
use Maatwebsite\Excel\Facades\Excel;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loan = loanData::all();
        $l_Maindata = mainDatas::all();
        $l_Category = Category::all();
        return view('loan.index', compact('loan', 'l_Maindata','l_Category'));
    }

    public function export()
    {
        return Excel::download(new LoanExport, 'Loan-data.xlsx');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loan = new LoanData();
        $lastRecord = LoanData::latest('id')->first();
        $lastId = $lastRecord ? $lastRecord->id : 0;
        $loan_code = 'LOAN-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        $loan->loan_code = $loan_code;

        $l_Maindata = mainDatas::findOrFail($request->item_id);
        $l_Maindata->stock -= $request->amount;
        $l_Maindata->save();

        $loan->amount = $request->amount;
        $loan->item_id = $request->item_id;
        $loan->loan_date = $request->loan_date;
        $loan->brws_name = $request->brws_name;
        $loan->info = $request->info;
        $loan->save();

        return redirect()->route('loan.index')->with('add_success', 'data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function return(Request $request, $id)
    {
        $loan = loanData::findOrFail($id);
        $lMaindata = mainDatas::findOrFail($loan->item_id);
        // Tambahkan kembali jumlah sebelumnya ke stok
        $lMaindata->stock += $loan->amount;
        $lMaindata->save();
        $loan->amount = $request->amount;
        $loan->status = $request->status;
        $loan->save();

        return redirect()->route('loan.index')->with('return_success', 'data has been added');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $loan = loanData::findOrFail($id);
        $l_Maindata = mainDatas::all();
        if ($request->filled('loan_code')) {
            $request->validate([
                'loan_code' => ['string', 'confirmed'],
            ]);

            $lastRecord = loanData::latest('id')->first();
            $lastId = $lastRecord ? $lastRecord->id : 0;
            $loan_code = 'LOAN-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
            $loan->loan_code = $loan_code;

        }

        $lMaindata = mainDatas::findOrFail($loan->item_id);
        // Tambahkan kembali jumlah sebelumnya ke stok
        $lMaindata->stock += $loan->amount;

        // Kurangi stok dengan jumlah baru
        $lMaindata->stock -= $request->amount;
        $lMaindata->save();

        $loan->amount = $request->amount;
        $loan->item_id = $request->item_id;
        $loan->loan_date = $request->loan_date;
        $loan->brws_name = $request->brws_name;
        $loan->info = $request->info;


        $loan->save();

        return redirect()->route('loan.index')->with('edit_success', 'data has been added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan = loanData::findOrFail($id);
        if ($loan->status === 1) {
            $loan->delete();
            return redirect()->route('loan.index')->with('delete', 'success');
        } else {
            $lMaindata = mainDatas::findOrFail($loan->item_id);
            // Tambahkan kembali jumlah sebelumnya ke stok
            $lMaindata->stock += $loan->amount;
            $lMaindata->save();
            $loan->delete();
            return redirect()->route('loan.index')->with('delete_success', 'success');
        }
    }
}
