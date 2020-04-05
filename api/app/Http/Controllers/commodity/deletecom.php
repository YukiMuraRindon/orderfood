<?php

namespace App\Http\Controllers\commodity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class deletecom extends Controller
{
    //
    public function deletecom(Request $request){
        // return "This is del API";
        $id = $request->input('id');
        //return $id;
        DB::table('commodity')->where('comid', '=', $id)->delete();
        return 'done';
    }
}
