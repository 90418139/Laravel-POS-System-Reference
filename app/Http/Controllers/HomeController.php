<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\DB;

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
        return view('home');
    }

    public function dashboard(){

        $Labels = Transaction::groupBy(DB::raw('Date(created_at)'))->get();
        $Data = Transaction::groupBy(DB::raw('Date(created_at)'))
            ->selectRaw('sum(total_price) as sum, created_at')
            ->pluck('sum','created_at');
        $labels = '[';
        foreach ($Labels as $item){
            $labels = $labels.'"'.date_format($item->created_at, 'Y/m/d').'"'.',';
        }
        $labels = $labels.']';

        $data = '[';
        foreach ($Data as $item){
            $data = $data.'"'.$item.'"'.',';
        }
        $data = $data.']';

        $binding = [
            'title' => trans('Dashboard'),
            'labels' => $labels,
            'data' => $data,
        ];
        return view('transaction.total-sales-transaction', $binding);
    }

}
