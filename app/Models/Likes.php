<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    //
    protected $fillable = [
      'name','blog_url','signature','email','content','is_hide'
    ];

}
