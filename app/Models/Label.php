<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    //
    public $timestamps = false;

    protected $fillable =[
      'label_name',
      'color',
    ];

}
