<?php
/*
 * Created: 2020-03-31 09:29:49
 * Last Modified:2020-03-31 11:08:51
 * Filename:Testapi.php
 * Project:api
 * Author : YukiMuraRindon
 * Email : rinndonn@outlook.com
 * --------------------------------------------------------
 * Description: 
 */
namespace App\Http\Controllers;

class Testapi extends Controller
{
    public function test(){
        return response()->json([
            'id' => '123',
            'name' => '张三',
            'state' => '1'
        ]);
    }
}
