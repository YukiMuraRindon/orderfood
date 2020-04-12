<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class userlogin extends Controller
{
    //
    public function login(Request $request)
    {
        //只要发起登录行为，必然无token或token有误，均要重写
        $username = $request->input('username');
        $password = $request->input('password');
        $token = Str::random(64);
        //先查有没有这个用户
        $user = DB::table('user')
            ->select('username', 'nickname', 'status')
            ->where([
                ['username', '=', $username],
                ['password', '=', $password]
            ])
            ->first();
        if ($user == null) {
            return [
                'error_code' => '1',
                'message' => '登陆失败，请检查用户名和密码'
            ];
        } else {
            $login = DB::table('login')
                ->where([
                    ['username', '=', $username],
                ])
                ->first();
            if ($login == null) {
                //没登录过的要插入
                DB::table('login')->insert(
                    [
                        'token' => $token,
                        'username' => $username,
                        'nickname' => $user->nickname,
                        'status' => $user->status
                    ]
                );
            } else {
                //登陆过的要更新
                DB::table('login')
                    ->where('username', '=', $username)
                    ->update(
                        [
                            'token' => $token
                        ]
                    );
            }
        }
        //需要返回nickname，token,status
        return [
            'error_code' => '0',
            'nickname' => $user->nickname,
            'status' => $user->status,
            'token' => $token
        ];
    }
    public function check(Request $request)
    {
        $token = $request->input('token');
        $user = DB::table('login')
            ->select('username', 'nickname', 'status')
            ->where([
                ['token', '=', $token]
            ])
            ->first();
        if ($user == null) {
            //说明token无效
            return [
                'error_code' => '0',
                'msg' => 'Wrong token',
            ];
        } else if ($user->status == 1) {
            //普通用户权限
            return [
                'error_code' => '0',
                'status' => $user->status
            ];
        } else if ($user->status == 2) {
            //admin权限
            return [
                'error_code' => '0',
                'status' => $user->status
            ];
        } else {
            //其他错误情况
            return [
                'error_code' => '1',
                'msg' => 'System error!',
            ];
        }
    }
    public function logout(Request $request)
    {
        $token = $request->input('token');
        $user = DB::table('login')
            ->select('username', 'nickname', 'status')
            ->where([
                ['token', '=', $token]
            ])
            ->first();
        if ($user == null) {
            //说明token无效
            return [
                'error_code' => '0',
                'msg' => 'Wrong token',
            ];
        } else {
            //token正确的话
            DB::table('login')
                ->where('token', '=', $token)
                ->update(
                    [
                        'token' => ""
                    ]
                );
            return [
                'error_code' => '0',
                'msg' => 'Logout success',
            ];
        }
    }
}
