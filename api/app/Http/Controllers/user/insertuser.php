<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class insertuser extends Controller
{
    public function insertuser(Request $request){
        // return "this is insertuserapi"
         $username = $request->input('username');
         $password = $request->input('password');
         $nickname = $request->input('nickname');
         $tel = $request->input('tel');
         $address = $request->input('address');
         DB::table('user')->insert(
             [
                 'username' => $username,
                 'password' => $password,
                 'nickname' => $nickname,
                 'address' => $address,
                 'tel' => $tel
             ]
         );
         return 1;
    }
    //
}
