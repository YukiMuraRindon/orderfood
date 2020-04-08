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
        else if($id == "waiting"){
            $orders = DB::table('order')->where("sentstatus",$id)->get();
            return response()->json($orders);
        }
        else if($id == "sending"){
            $orders = DB::table('order')->where("sentstatus",$id)->get();
            return response()->json($orders);
        }
        else if($id == "finish"){
            $orders = DB::table('order')->where("sentstatus",$id)->get();
            return response()->json($orders);
        }
        else{
            $orders = DB::table('order')->where("orderid",$id)->get();
            return response()->json($orders);
            ;//根据订单号查订单
        }
    }
    public function selectorderdetail($id){
        $orderdetail = DB::table('orderdetail')->where("orderid",$id)->get();
        return response()->json($orderdetail);
    }
}
