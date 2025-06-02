<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\mainDatas;
use App\Models\outcomingItems;
use App\Exports\OutcomingExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class outcomingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $out_item = outcomingItems::all();
        $outMaindata = mainDatas::all();
        $outCategory = Category::all();
        return view('outcoming-item.index', compact('out_item', 'outMaindata', 'outCategory'));
    }

    public function export()
    {
        return Excel::download(new OutcomingExport, 'Outcoming-Data.xlsx');
    }

    public function exportPDF()
    {
        $out_item = outcomingItems::all();

        $pdf = Pdf::loadView('pdf.outcoming', compact('out_item'));

        return $pdf->download('Outcoming-item.pdf'); // Langsung download
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
        $this->validate($request, [
            'amount' => 'required|min:1',
            'item_id' => 'required',
            'exit_date' => 'required',
            'info' => 'required'
        ]);

        $out_item = new outcomingItems();
        $lastRecord = outcomingItems::latest('id')->first();
        $lastId = $lastRecord ? $lastRecord->id : 0;
        $out_code = 'OUTM-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        $out_item->out_code = $out_code;



        $outMaindata = mainDatas::findOrFail($request->item_id);
        // Cek stok cukup
        if ($outMaindata->stock < $request->amount) {
            return redirect()->back()->with('error', "Stok untuk item {$outMaindata->name} tidak cukup atau kosong.");
        }


        $outMaindata->stock -= $request->amount;
        $outMaindata->save();

        $out_item->amount = $request->amount;
        $out_item->item_id = $request->item_id;
        $out_item->exit_date = $request->exit_date;
        $out_item->info = $request->info;
        $out_item->save();

        return redirect()->route('outcoming-item.index')->with('add_success', 'data has been added');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required|integer|min:1',
            'item_id' => 'required|exists:maindatas,id',
            'exit_date' => 'required',
            'info' => 'required'
        ]);

        $out_item = outcomingItems::findOrFail($id);

        // Jika item_id tidak berubah
        if ($out_item->item_id == $request->item_id) {
            $mainData = mainDatas::findOrFail($out_item->item_id);

            // Kembalikan stok lama
            $mainData->stock += $out_item->amount;

            // Cek stok cukup untuk jumlah baru
            if ($mainData->stock < $request->amount) {
                return redirect()->back()->with('error', "Stock for this item {$mainData->name} was empty.");
            }

            // Kurangi stok dengan jumlah baru
            $mainData->stock -= $request->amount;
            $mainData->save();
        } else {
            // Jika item_id berubah
            $oldMainData = mainDatas::findOrFail($out_item->item_id);
            $newMainData = mainDatas::findOrFail($request->item_id);

            // Kembalikan stok lama
            $oldMainData->stock += $out_item->amount;
            $oldMainData->save();

            // Cek stok cukup untuk item baru
            if ($newMainData->stock < $request->amount) {
                return redirect()->back()->with('error', "Stok untuk item {$newMainData->name} tidak cukup atau kosong.");
            }

            // Kurangi stok item baru
            $newMainData->stock -= $request->amount;
            $newMainData->save();
        }

        // Update data keluar
        $lastRecord = outcomingItems::latest('id')->first();
        $lastId = $lastRecord ? $lastRecord->id : 0;
        $out_code = 'OUTM-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
        $out_item->out_code = $out_code;

        $out_item->amount = $request->amount;
        $out_item->item_id = $request->item_id;
        $out_item->exit_date = $request->exit_date;
        $out_item->info = $request->info;
        $out_item->save();

        return redirect()->route('outcoming-item.index')->with('edit_success', 'data has been edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $out_item = outcomingItems::findOrFail($id);
        $outMaindata = mainDatas::findOrFail($out_item->item_id);
        $outMaindata->stock += $out_item->amount;
        $outMaindata->save();
        $out_item->delete();
        return redirect()->route('outcoming-item.index')->with('delete_success', 'data has been delete');
    }
}
