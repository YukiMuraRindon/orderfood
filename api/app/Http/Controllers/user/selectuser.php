<?php
/*
 * Created: 2020-03-31 10:37:49
 * Last Modified:2020-03-31 11:11:20
 * Filename:select.php
 * Project:api
 * Author : YukiMuraRindon
 * Email : rinndonn@outlook.com
 * --------------------------------------------------------
 * Description: 
 */

namespace App\Http\Controllers;

use App\Models\user;

class selectuser extends Controller
{
    public function selectuser($username)
    {
        if($username == "all"){
            $users = user::all();
            return response()->json($users);
        }
        else{
            $users = user::where("username",$username)->get();
            return response()->json($users);
            ;//根据用户名查用户
        }
    }
    // 不是命令创建的类要更新autoload！！！！控制台指令：compuser dump-autoload！！！
}
