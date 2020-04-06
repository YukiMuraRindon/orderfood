<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class updateuser extends Controller
{
    public function updateuser(Request $request){
        $id = $request->input('userid');
        $username = $request->input('username');
        $password = $request->input('password');
        $nickname = $request->input('nickname');
        $tel = $request->input('tel');
        $address = $request->input('address');
        DB::table('user')
            ->where('userid', $id)
            ->update([
                'username' => $username,
                'password' => $password,
                'nickname' => $nickname,
                'tel' => $tel,
                'address' => $address
            ]);
        return 1;
    }
}
