<?php

namespace App\Http\Controllers;

use App\Models\mainDatas;
use App\Models\Room;
use App\Models\Room_Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RoomItemsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class RoomItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupedItems = DB::table('room_items')
            ->select('rooms_id', 'item_id', DB::raw('SUM(amount) as total_amount'))
            ->groupBy('rooms_id', 'item_id')
            ->get();


        $room = Room::all();
        $mainData = mainDatas::all();

        return view('room_items.index', compact('groupedItems', 'room', 'mainData'));
    }

    public function export()
    {
        return Excel::download(new RoomItemsExport, 'Room_Items.xlsx');
    }

    public function exportPDF()
    {
        $groupedItems = DB::table('room_items')
            ->select('rooms_id', 'item_id', DB::raw('SUM(amount) as total_amount'))
            ->groupBy('rooms_id', 'item_id')
            ->get();
        $room = Room::all();
        $mainData = mainDatas::all();

        $pdf = Pdf::loadView('pdf.room_items', compact('groupedItems', 'room', 'mainData'));

        return $pdf->download('Room-Item.pdf'); // Langsung download
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
            'rooms_id' => 'required|exists:room,id', // Ensure the table name is correct
            'item_id' => 'required|array',
            'item_id.*' => 'required|exists:maindatas,id',
            'amount' => 'required|array',
            'amount.*' => 'required|integer|min:1',
        ]);

        foreach ($request->item_id as $i => $item_id) {
            $amount = $request->amount[$i];

            // Cek stok item
            $item = mainDatas::findOrFail($item_id);
            if ($item->stock < $amount) {
                return redirect()->back()->with('error', "Stok untuk item {$item->name} tidak cukup atau kosong.");
            }

            // Check if the record already exists
            $existingItem = Room_Items::where('rooms_id', $request->rooms_id)
                ->where('item_id', $item_id)
                ->first();

            if ($existingItem) {
                // If it exists, increment the amount
                $existingItem->amount += $amount;
                $existingItem->save();
            } else {
                // If it doesn't exist, create a new record
                Room_Items::create([
                    'rooms_id' => $request->rooms_id,
                    'item_id' => $item_id,
                    'amount' => $amount,
                ]);
            }

            // Update stock
            $item = mainDatas::findOrFail($item_id);
            $item->stock -= $amount;
            $item->save();
        }

        return redirect()->route('room_items.index')->with('add_success', 'Items successfully added.');
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
    public function update(Request $request, $rooms_id, $item_id)
    {
        $this->validate($request, [
            'amount' => 'required|integer|min:1',
            'item_id' => 'required|integer',
        ]);

        \DB::beginTransaction();

        try {
            $new_item_id = $request->item_id;
            $amount = $request->amount;

            // Cek stok item
            $item = mainDatas::findOrFail($item_id);
            if ($item->stock < $amount) {
                return redirect()->back()->with('error', "Stok untuk item {$item->name} tidak cukup atau kosong.");
            }

            $existingItem = Room_Items::where('rooms_id', $rooms_id)
                ->where('item_id', $item_id)
                ->first();

            if (!$existingItem) {
                return redirect()->back()->with('error', "No records found for item ID {$item_id} in the specified room.");
            }

            // Jika item_id berubah
            if ($item_id != $new_item_id) {
                // Kembalikan stok lama
                $oldMainItem = mainDatas::findOrFail($item_id);
                $oldMainItem->stock += $existingItem->amount;
                $oldMainItem->save();

                // Kurangi stok baru
                $newMainItem = mainDatas::findOrFail($new_item_id);
                if ($newMainItem->stock < $amount) {
                    return redirect()->back()->with('error', "Insufficient stock for item ID {$new_item_id}.");
                }
                $newMainItem->stock -= $amount;
                $newMainItem->save();

                // Update relasi item_id dan amount
                $existingItem->item_id = $new_item_id;
                $existingItem->amount = $amount;
                $existingItem->save();
            } else {
                // Jika item_id sama, update amount dan stok
                $mainItem = mainDatas::findOrFail($item_id);
                $selisih = $amount - $existingItem->amount;
                if ($mainItem->stock < $selisih) {
                    return redirect()->back()->with('error', "Insufficient stock for item ID {$item_id}.");
                }
                $mainItem->stock -= $selisih;
                $mainItem->save();

                $existingItem->amount = $amount;
                $existingItem->save();
            }

            \DB::commit();
            return redirect()->route('room_items.index')->with('edit_success', 'Item successfully updated.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating item: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'rooms_id' => 'required|integer',
            'item_id' => 'required|integer',
        ]);

        $roomItem = Room_Items::where('rooms_id', $request->rooms_id)
            ->where('item_id', $request->item_id)
            ->first();

        if (!$roomItem) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        // Restore stock
        $item = mainDatas::findOrFail($request->item_id);
        $item->stock += $roomItem->amount;
        $item->save();

        $roomItem->delete();

        return redirect()->route('room_items.index')->with('delete_success', 'Item successfully deleted and stock updated.');
    }
}
