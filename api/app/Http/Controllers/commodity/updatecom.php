<?php

namespace App\Http\Controllers\commodity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class updatecom extends Controller
{
    public function updatecom(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $kind = $request->input('kind');
        $stock = $request->input('stock');
        $disc = $request->input('disc');
        $img = $request->input('img');
        $price = $request->input('price');
        switch ($kind) {
            case "lu":
                $kind = "鲁菜";
                break;
            case "chuan":
                $kind = "川菜";
                break;
            case "yue":
                $kind = "粤菜";
                break;
            case "su":
                $kind = "苏菜";
                break;
            case "min":
                $kind = "闽菜";
                break;
            case "zhe":
                $kind = "浙菜";
                break;
            case "hui":
                $kind = "徽菜";
                break;
            case "xiang":
                $kind = "湘菜";
                break;
        }
        DB::table('commodity')
            ->where('comid', $id)
            ->update([
                'comname' => $name,
                'comkind' => $kind,
                'comstock' => $stock,
                'comdisc' => $disc,
                'comimg' => $img,
                'comprice' => $price
            ]);
        return [
            'error_code' => '0'
        ];
    }
    //
}
