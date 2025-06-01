<?php

namespace App\Http\Controllers;

use App\Models\mainDatas;
use App\Models\Room;
use App\Models\Room_Items;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\RoomExport;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = Room::all();
        $mainData = mainDatas::all();
        return view('room.index', compact('room', 'mainData'));
    }
    public function export()
    {
        return Excel::download(new RoomExport, 'Room.xlsx');
    }

    public function exportPDF()
    {
        $room = Room::all();

        $pdf = Pdf::loadView('pdf.room', compact('room'));

        return $pdf->download('Room-data.pdf'); // Langsung download
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
            'room_name' => 'required',
        ]);

        $room = new Room();

        $lastRecord = Room::latest('id')->first();
        $lastId = $lastRecord ? $lastRecord->id : 0;
        $room_code = 'ROOM-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        $room->room_code = $room_code;
        $room->room_name = $request->room_name;
        $room->save();
        return redirect()->route('room.index')->with('add_success', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
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
            'room_name' => 'required',
        ]);
        
        $room = Room::findOrFail($id);
        $room->room_name = $request->room_name;
        $room->save();
        return redirect()->route('room.index')->with('edit_success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->route('room.index')->with('delete_success', 'success');
    }
}
