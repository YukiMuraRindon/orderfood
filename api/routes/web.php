<?php
/*
 * Created: 2020-03-30 10:24:41
 * Last Modified:2020-03-31 11:08:26
 * Filename:web.php
 * Project:api
 * Author : YukiMuraRindon
 * Email : rinndonn@outlook.com
 * --------------------------------------------------------
 * Description: 
 */

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function ($id = null) {
    // 可选传参
    abort(404);
    // 不规定id约束的话所有传入都当字符串处理了
    // 踩坑预警：下面路由没法访问的话nginx要加上try_files $uri $uri/ /index.php?$query_string; 是中间件的问题
});

Route::prefix('login')->group(function () {
    Route::get('/', function () {
        abort(404);
        //return "This is login api";
    });
    Route::post('login/', 'login\userlogin@login');
    Route::post('check/', 'login\userlogin@check');
    Route::post('logout/', 'login\userlogin@logout');
    Route::post('regist/', 'login\registuser@regist');
});


Route::prefix('commodity')->group(function () {
    Route::get('/', function () {
        abort(404);
    });
    //查询所有商品
    Route::get('select/{kind?}', 'selectcommodity@selectall');
    Route::post('insert/', 'commodity\insert@insertcommodity');
    Route::post('deletecom/', 'commodity\deletecom@deletecom');
    Route::post('updatecom/', 'commodity\updatecom@updatecom');
});

Route::prefix('order')->group(function () {
    Route::get('/', function () {
        // return 'This is OrderApi';
        abort(404);
    });
    Route::get('selectorder/{id?}', 'order\selectorder@selectorder');
    Route::get('selectuserorder/{nickname?}', 'order\selectorder@selectuserorder');
    Route::get('selectorderdetail/{id?}', 'order\selectorder@selectorderdetail');
    Route::post('updateorder/', 'order\updateorder@updatestatus');
    Route::post('finishorder/', 'order\updateorder@finishorder');
});

Route::prefix('user')->group(function () {
    Route::get('/', function () {
        // return 'This is UserApi';
        abort(404);
    });
    Route::get('selectuser/{username}', 'selectuser@selectuser');
    Route::post('insertuser/', 'user\insertuser@insertuser');
    Route::post('deleteuser/', 'user\deleteuser@deleteuser');
    Route::post('updateuser/', 'user\updateuser@updateuser');
});
