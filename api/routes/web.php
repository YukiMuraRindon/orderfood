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

Route::get('/{id?}', function($id=null){
    // 可选传参
    if($id==null){
        return 'This is the api root!';
    }
    else{
        return 'This is the api root! And your id is ' . $id;
        // php的字符串拼接用.运算符
    }
    // 不规定id约束的话所有传入都当字符串处理了
    // 踩坑预警：下面路由没法访问的话nginx要加上try_files $uri $uri/ /index.php?$query_string; 是中间件的问题
})->where('id','[0-9]+'); 

Route::prefix('commodity')->group(function(){
    Route::get('/',function(){
        return 'This is commodityApi';
    });
    //查询所有商品
    Route::get('select/{kind?}','selectcommodity@selectall');
    Route::post('insert/','commodity\insert@insertcommodity');
    Route::post('deletecom/','commodity\deletecom@deletecom');
    Route::post('updatecom/','commodity\updatecom@updatecom');
});

Route::prefix('order')->group(function(){
    Route::get('/',function(){
        return 'This is OrderApi';
    });
    Route::get('selectorder/{id?}','order\selectorder@selectorder');
    Route::get('selectorderdetail/{id?}','order\selectorder@selectorderdetail');
    Route::post('updateorder/','order\updateorder@updatestatus');
});

Route::prefix('user')->group(function(){
    Route::get('/',function(){
        return 'This is UserApi';
    });
    Route::get('selectuser/{username}','selectuser@selectuser');
    Route::post('insertuser/','user\insertuser@insertuser');
    Route::post('deleteuser/','user\deleteuser@deleteuser');
    Route::post('updateuser/','user\updateuser@updateuser');
});