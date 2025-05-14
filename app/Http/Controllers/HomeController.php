<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\mainDatas;
use App\Models\Category;
use App\Models\incomingItems;
use App\Models\outcomingItems;
use App\Models\loanData;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalStaff = User::count(); 
        $totalData = mainDatas::count();
        $totalCategory = Category::count();
        $totalIncoming = incomingItems::count();
        $totalOutcoming = outcomingItems::count();
        $totalLoan = loanData::count();
        $totalReturn = loanData::where('status', 1)->count();

        $chartData = [
            'name' => ['Total Incoming','Total Outcoming','Total Loan', 'Total Return'],
            'series' => [$totalIncoming, $totalOutcoming, $totalLoan, $totalReturn]
        ];

        return view('welcome', compact('chartData','totalStaff','totalData','totalCategory','totalIncoming','totalOutcoming','totalLoan','totalReturn'));
    }

    

}
