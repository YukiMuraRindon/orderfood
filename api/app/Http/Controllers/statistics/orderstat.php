<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class orderstat extends Controller
{
    public function statorder(){
        // $orders = DB::table('orderdetail')
        //     ->select('comkind',sum('comnum'))
        //     ->get()
        //     ->groupBy('comkind');
        $order1 = DB::table('orderdetail')
                ->select('comnum')
                ->where('comkind','=','鲁菜')
                ->get()
                ->sum('comnum');
        $order2 = DB::table('orderdetail')
                ->select('comnum')
                ->where('comkind','=','川菜')
                ->get()
                ->sum('comnum');
        $order3 = DB::table('orderdetail')
                ->select('comnum')
                ->where('comkind','=','粤菜')
                ->get()
                ->sum('comnum');
        
        return[
            'lu' => $order1,
            'chuan' => $order2,
            'yue' => $order3
        ];

    }
    public $sql = '(select userid,sum(ordprice) from `order` GROUP BY (userid))';
    public function statuserord(){
        $user = DB::select('select userid,sum(ordprice) as price from `order` GROUP BY (userid) ORDER BY price desc');
        return $user;
    }
}
