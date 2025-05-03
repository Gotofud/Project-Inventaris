<?php

namespace App\Http\Controllers;

use App\Models\incomingItems;
use App\Models\mainDatas;
use Illuminate\Http\Request;

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
        return view('incoming-item.index', compact('icm_item', 'icmMaindata'));
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

        return redirect()->route('incoming-item.index')->with('icm_success', 'data has been added');
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
        $icmMaindata = mainDatas::all();
        if ($request->filled('icm_code')) {
            $request->validate([
                'icm_code' => ['string', 'confirmed'],
            ]);

            $lastRecord = incomingItems::latest('id')->first();
            $lastId = $lastRecord ? $lastRecord->id : 0;
            $icm_code = 'INCM-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
            $icm_item->icm_code = $icm_code;

        }

        $icmMaindata = mainDatas::findOrFail($request->item_id);
        $icmMaindata->stock += $request->amount;
        $icmMaindata->save();   

        $icm_item->amount = $request->amount;
        $icm_item->item_id = $request->item_id;
        $icm_item->entry_date = $request->entry_date;
        $icm_item->info = $request->info;


        $icm_item->save();

        return redirect()->route('incoming-item.index')->with('edit_success', 'data has been added');
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
        $icmMaindata = mainDatas::all();
        $icm_item->delete();

        return redirect()->route('incoming-item.index')->with('delete_success', 'data has been deleted');
    }
}
