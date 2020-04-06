<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class deleteuser extends Controller
{
    //
    public function deleteuser(Request $request){
        //  return "This is del API";
         $id = $request->input('userid');
         //return $id;
         DB::table('user')->where('userid', '=', $id)->delete();
         return 'done';
         //推荐把用户状态改为0，然后selectall的时候只搜1和2
    }
}
