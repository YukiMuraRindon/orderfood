<?php
/*
 * Created: 2020-04-01 09:44:35
 * Last Modified:2020-04-01 09:44:46
 * Filename:selectcommdity.php
 * Project:api
 * Author : YukiMuraRindon
 * Email : rinndonn@outlook.com
 * --------------------------------------------------------
 * Description: 
 */

namespace App\Http\Controllers;

use App\Models\commodity;

class selectcommodity extends Controller
{
    public function selectall($kind)
    {
        if ($kind == 'all') { //查询所有
            $com = commodity::all();
            return response()->json($com);
        } else {
            switch ($kind) {
                case "lu":
                    //查询鲁菜
                    $com = commodity::where("comkind","鲁菜")->get();
                    return response()->json($com);
                    break;
                case "chuan":
                    //查询川菜
                    $com = commodity::where("comkind","川菜")->get();
                    return response()->json($com);
                    break;
                case "yue":
                    //查询粤菜
                    $com = commodity::where("comkind","粤菜")->get();
                    return response()->json($com);
                    break;
            }
        }
    }
    // 不是命令创建的类要更新autoload！！！！控制台指令：compuser dump-autoload！！！
}
