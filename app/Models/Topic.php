<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //

    protected $table = '';

    protected $fillable = [
        'topic_id',
        'category_id',
        'user_id',
        'to_uid',
        'content',
    ];



}
