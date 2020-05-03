<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveMessageModel extends Model
{
    //
    protected $table = 'leave_message';

    protected $fillable = ['name','email','content','status'];
}
