<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class setorder extends Controller
{
    public function setorder(Request $request)
    {
        $nickname = $request->input('nickname');
        $ordprice = $request->input('ordprice');
        $ordststus = $request->input('ordstatus');
        $sentstatus = $request->input('sentstatus');

        $user = DB::table('user')
            ->select('userid')
            ->where([
                ['nickname', '=', $nickname]
            ])
            ->first();
        $userid = $user->userid;

        DB::table('order')->insert(
            [
                'userid' => $userid,
                'ordprice' => $ordprice,
                'ordstatus' => $ordststus,
                'sentstatus' => $sentstatus
            ]
        );

        $order = DB::table('order')
            ->select('orderid')
            ->where([
                ['userid', '=', $userid]
            ])
            ->orderBy('orderid', 'desc')
            ->first();

        return [
            'error_code' => '0',
            'orderid' => $order->orderid
        ];
    }
    public function setorderdetail(Request $request)
    {
        $orderid = $request->input('orderid');
        $comid = $request->input('comid');
        $comname = $request->input('comname');
        $comkind = $request->input('comkind');
        $comnum = $request->input('comnum');

        $stock = DB::table('commodity')
            ->select('comstock', 'comname')
            ->where([
                ['comid', '=', $comid]
            ])
            ->first();

        if (($stock->comstock) < $comnum) {
            return [
                'error_code' => '1',
                'message' => $stock->comname + "库存不足！"
            ];
        } else {
            DB::table('orderdetail')->insert(
                [
                    'orderid' => $orderid,
                    'comid' => $comid,
                    'comname' => $comname,
                    'comkind' => $comkind,
                    'comnum' => $comnum
                ]
            );

            DB::table('commodity')->update(
                [
                    'comstock' => $stock->comstock - $comnum
                ]
            );

            return [
                'error_code' => '0',
                'message' => "下单成功"
            ];
        }
    }
}
