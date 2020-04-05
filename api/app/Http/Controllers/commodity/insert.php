<?php

namespace App\Http\Controllers\commodity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class insert extends Controller
{
    public function insertcommodity(Request $request)
    {
        $name = $request->input('name');
        $kind = $request->input('kind');
        $stock = $request->input('stock');
        $disc = $request->input('disc');
        $img = $request->input('img');
        $price = $request->input('price');
        switch($kind){
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
        //先取出值
        //
        // $this->name = $name;
        // $this->kind = $kind;
        // $this->stock = $stock;
        // $this->disc = $disc;
        // $this->img = $img;
        // $this->price = $price;
        // $this->save();
        //Eloquent还没搞懂，先用构造器
        //执行查询构造器
        DB::table('commodity')->insert(
            [
                'comname' => $name,
                'comkind' => $kind,
                'comstock' => $stock,
                'comdisc' => $disc,
                'comimg' => $img,
                'comprice' => $price
            ]
        );
        return 1;
    }
}
