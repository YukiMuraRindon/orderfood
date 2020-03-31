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

class Selectapi extends Controller
{
    public function test(){
        return 'This is select api';
    }
    // 不是命令创建的类要更新autoload！！！！控制台指令：compuser dump-autoload！！！
}
