<?php
/**
 * Created by PhpStorm
 * User: pl
 * Date: 2020/9/10
 * Time: 16:08
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SubscribeModel extends Model
{
    protected $table = 'subscribe';

    protected $fillable = ['email','client','status'];
}
