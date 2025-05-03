<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mainDatas;
use App\Models\Category;
use App\Exports\MainDataExport;
use Maatwebsite\Excel\Facades\Excel;

class mainDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainData = mainDatas::all();
        $category = Category::all();
        return view('mainData.index', compact('mainData','category'));
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
        $mainData = new mainDatas();
        $lastRecord = mainDatas::latest('id')->first();
        $lastId = $lastRecord ? $lastRecord->id : 0;
        $prd_code = 'ITEM-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        $mainData->prd_code = $prd_code;
        $mainData->name = $request->name;
        $mainData->category_id = $request->category_id;

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $name = rand(1000,9999) . $img->getClientOriginalName();
            $img->move('images/data',$name);
            $mainData->img = $name;
        } else {
            $mainData->img = null;
        }

        $mainData->save();

        return redirect()->route('mainData.index')->with('item_success','data has been added');
    }

    public function export() {
      return Excel::download(new MainDataExport, 'Main-Data.xlsx');
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
        $mainData = mainDatas::findOrFail($id);
        $category = Category::all();
        if ($request->filled('prd_code')) {
            $request->validate([
                'prd_code' => ['string','confirmed'],
            ]);

            $lastRecord = mainDatas::latest('id')->first();
            $lastId = $lastRecord ? $lastRecord->id : 0;
            $prd_code = 'ITEM-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT); 
            $mainData->prd_code = $prd_code;
            
          }

            $mainData->name = $request->name;
            $mainData->category_id = $request->category_id;
    
            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $name = rand(1000,9999) . $img->getClientOriginalName();
                $img->move('images/data',$name);
                $mainData->img = $name;
            } else {
                $mainData->img = null;
            }
    
            $mainData->save();
    
            return redirect()->route('mainData.index')->with('edit_success','data has been added');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mainData = mainDatas::findOrFail($id);
        $mainData->delete();
        return redirect()->route('mainData.index')->with('delete_success','data has been deleted');
    }
}
