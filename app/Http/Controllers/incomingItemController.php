<?php

namespace App\Http\Controllers;

use App\Models\incomingItems;
use App\Models\loanData;
use App\Models\mainDatas;
use App\Models\Category;
use App\Models\outcomingItems;
use Illuminate\Http\Request;
use App\Exports\IncomingExport;
use Maatwebsite\Excel\Facades\Excel;

class incomingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $icm_item = incomingItems::all();
        $icmMaindata = mainDatas::all();
        $icm_out = outcomingItems::all();
        return view('incoming-item.index', compact('icm_item', 'icmMaindata', 'icm_out'));
    }

    public function export()
    {
        return Excel::download(new incomingExport, 'icm_item-Data.xlsx');
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
        $icm_item = new incomingItems();
        $lastRecord = incomingItems::latest('id')->first();
        $lastId = $lastRecord ? $lastRecord->id : 0;
        $icm_code = 'INCM-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        $icm_item->icm_code = $icm_code;

        $icmMaindata = mainDatas::findOrFail($request->item_id);
        $icmMaindata->stock += $request->amount;
        $icmMaindata->save();

        $icm_item->amount = $request->amount;
        $icm_item->item_id = $request->item_id;
        $icm_item->entry_date = $request->entry_date;
        $icm_item->info = $request->info;
        $icm_item->save();

        return redirect()->route('incoming-item.index')->with('add_success', 'data has been added');
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
        $icm_item = incomingItems::findOrFail($id);
        $icmMaindata = mainDatas::findOrFail($icm_item->item_id);

        // Tambahkan kembali jumlah sebelumnya ke stok
        $icmMaindata->stock += $request->amount;

        // Kurangi stok dengan jumlah baru
        $icmMaindata->stock -= $icm_item->amount;
        $icmMaindata->save();

        $lastRecord = incomingItems::latest('id')->first();
        $lastId = $lastRecord ? $lastRecord->id : 0;
        $icm_code = 'INCM-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
        $icm_item->icm_code = $icm_code;

        $icm_item->amount = $request->amount;
        $icm_item->item_id = $request->item_id;
        $icm_item->entry_date = $request->entry_date;
        $icm_item->info = $request->info;
        $icm_item->save();

        return redirect()->route('incoming-item.index')->with('edit_success', 'data has been edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $icm_item = incomingItems::findOrFail($id);

        outcomingItems::where('item_id', $icm_item->item_id)->delete();
        loanData::where('item_id', $icm_item->item_id)->delete();

        $mainData = mainDatas::findOrFail($icm_item->item_id);
        $mainData->stock -= $icm_item->amount;
        $mainData->save();

        $icm_item->delete();

        return redirect()->route('incoming-item.index')->with('delete_success', 'icm_item and related outcoming items deleted');
    }


}
