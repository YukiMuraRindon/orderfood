<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class selectorder extends Controller
{
    public function selectorder($id)
    {
        if($id == "all"){
            $orders = DB::table('order')->get();
            return response()->json($orders);
        }
        else{
            $orders = DB::table('order')->where("orderid",$id)->get();
            return response()->json($orders);
            ;//根据订单号查订单
        }
    }
}
