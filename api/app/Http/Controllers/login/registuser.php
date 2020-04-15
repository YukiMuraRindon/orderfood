<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class registuser extends Controller
{
    public function regist(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $nickname = $request->input('nickname');
        $address = $request->input('address');
        $telephone = $request->input('telephone');
        $token = Str::random(64);
        //先创建用户
        DB::table('user')
            ->insert([
                'username' => $username,
                'password' => $password,
                'nickname' => $nickname,
                'address' => $address,
                'tel' => $telephone
            ]);
            //再插入登录状态
        DB::table('login')->insert(
            [
                'token' => $token,
                'username' => $username,
                'nickname' => $nickname,
                'status' => 1
            ]
        );
        //返回token
        return [
            'error_code' => '0',
            'nickname' => $nickname,
            'token' => $token
        ];
    }
}
