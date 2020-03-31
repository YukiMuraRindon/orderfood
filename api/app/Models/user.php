<?php
/*
 * Created: 2020-03-31 19:11:34
 * Last Modified:2020-03-31 19:13:30
 * Filename:user.php
 * Project:api
 * Author : YukiMuraRindon
 * Email : rinndonn@outlook.com
 * --------------------------------------------------------
 * Description: 
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    //关联数据表
    protected $table = 'user';
    //无需维护时间戳
    public $timestamps = false;
}
