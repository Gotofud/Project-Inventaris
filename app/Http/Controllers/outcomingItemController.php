<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mainDatas;
use App\Models\outcomingItems;

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
        return view('outcoming-item.index', compact('out_item', 'outMaindata'));
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
        $out_item = new outcomingItems();
        $lastRecord = outcomingItems::latest('id')->first();
        $lastId = $lastRecord ? $lastRecord->id : 0;
        $out_code = 'OUTM-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        $out_item->out_code = $out_code;

        $outMaindata = mainDatas::findOrFail($request->item_id);
        $outMaindata->stock -= $request->amount;
        $outMaindata->save();

        $out_item->amount = $request->amount;
        $out_item->item_id = $request->item_id;
        $out_item->exit_date = $request->exit_date;
        $out_item->info = $request->info;
        $out_item->save();

        return redirect()->route('outcoming-item.index')->with('out_success', 'data has been added');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
