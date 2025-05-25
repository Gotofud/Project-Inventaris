<?php

namespace App\Http\Controllers;

use App\Models\mainDatas;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Exports\CategoryExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all()->map(function ($item) {
            $item->totalCategory = mainDatas::where('category_id', $item->id)->count();
            return $item;
        });
        return view('category.index', compact('category'));
    }

    public function export()
    {
        return Excel::download(new CategoryExport, 'Category.xlsx');
    }
    public function exportPDF()
    {
        $category = Category::all()->map(function ($item) {
            $item->totalCategory = mainDatas::where('category_id', $item->id)->count();
            return $item;
        });

        $pdf = Pdf::loadView('pdf.category', compact('category'));

        return $pdf->download('Category.pdf'); // Langsung download
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
            'name' => 'required|max:200'
        ]);

        $category = new Category();
        $category->category_name = $request->name;
        $category->save();

        return redirect()->route('category.index')->with('category_success', 'success');
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
            'name' => 'required|max:200'
        ]);

        $category = Category::findOrFail($id);
        $category->category_name = $request->name;
        $category->save();

        return redirect()->route('category.index')->with('edit_success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('delete_success', 'success');
    }
}
