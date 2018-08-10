<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\UserUpdate;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = \Auth::User()->id;
        $newCustomers = Customer::where('user_id', $id)->count();
        $totalUpdates = UserUpdate::where('user_id', $id)->count();
        $confirmedSale = UserUpdate::where([
            ['user_id', '=', $id],
            ['disposition_id', '=', 2]
        ])->count();
        $followUps = UserUpdate::where([
            ['user_id', '=', $id],
            ['disposition_id', '=', 1]
        ])->count();

        return view('home', ['newCustomers' => $newCustomers, 'totalUpdates' => $totalUpdates, 'followUps' => $followUps, 'confirmedSale' => $confirmedSale, 'followUps' => $followUps]);
    }
}
