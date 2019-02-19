<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\UserUpdate;
use DB;

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

        $newCustomersChartData = DB::select("SELECT * FROM(
            SELECT DATE(created_at) AS creation_date, COUNT(*) AS new_customers 
            FROM customers 
            WHERE user_id = $id 
            AND created_at BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()
            GROUP BY creation_date
            UNION
            SELECT * FROM
            (SELECT adddate('1970-01-01',t4*10000 + t3*1000 + t2*100 + t1*10 + t0) AS creation_date, 0 AS new_customers FROM
            (SELECT 0 t0 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0,
            (SELECT 0 t1 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
            (SELECT 0 t2 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
            (SELECT 0 t3 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
            (SELECT 0 t4 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4) v
            WHERE creation_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()
            ) AS foo ORDER BY creation_date
            ");

        $newCustomersChartData = json_encode($newCustomersChartData);

        $confirmedSaleChartData = DB::select("SELECT * FROM(
            SELECT DATE(created_at) AS creation_date, COUNT(*) AS confirmed_sales 
            FROM user_updates 
            WHERE user_id = $id 
            AND disposition_id = 2
            AND created_at BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()
            GROUP BY creation_date
            UNION
            SELECT * FROM
            (SELECT adddate('1970-01-01',t4*10000 + t3*1000 + t2*100 + t1*10 + t0) AS creation_date, 0 AS new_customers FROM
            (SELECT 0 t0 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0,
            (SELECT 0 t1 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
            (SELECT 0 t2 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
            (SELECT 0 t3 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
            (SELECT 0 t4 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4) v
            WHERE creation_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()
            ) AS foo ORDER BY creation_date
            ");

        $confirmedSaleChartData = json_encode($confirmedSaleChartData);

        $conversionChartData = DB::select("SELECT * FROM(
            SELECT DATE(created_at) AS creation_date, COUNT(*) AS conversions 
            FROM user_updates 
            WHERE user_id = $id 
            AND created_at BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()
            GROUP BY creation_date
            UNION
            SELECT * FROM
            (SELECT adddate('1970-01-01',t4*10000 + t3*1000 + t2*100 + t1*10 + t0) AS creation_date, 0 AS new_customers FROM
            (SELECT 0 t0 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0,
            (SELECT 0 t1 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
            (SELECT 0 t2 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
            (SELECT 0 t3 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
            (SELECT 0 t4 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4) v
            WHERE creation_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()
            ) AS foo ORDER BY creation_date
            ");

        $conversionChartData = json_encode($conversionChartData);

        return view('home', ['newCustomers' => $newCustomers, 'totalUpdates' => $totalUpdates, 'followUps' => $followUps, 'confirmedSale' => $confirmedSale, 
            'followUps' => $followUps, 'newCustomersChartData' => $newCustomersChartData, 'confirmedSaleChartData' => $confirmedSaleChartData, 'conversionChartData' => $conversionChartData]);
    }
}
