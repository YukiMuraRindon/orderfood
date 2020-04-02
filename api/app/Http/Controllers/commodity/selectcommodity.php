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
        if ($kind == 'all') {//查询所有
            $com = commodity::all();
            return response()->json($com);
        }
        else{
            return 'waiting';
        }
    }
    // 不是命令创建的类要更新autoload！！！！控制台指令：compuser dump-autoload！！！
}
