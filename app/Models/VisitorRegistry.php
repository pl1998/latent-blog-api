<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorRegistry extends Model
{
    //
    protected $fillable = ['art_id','ip','clicks','created_at'];

    public function article()
    {
        return $this->hasOne(Article::class,'id','art_id');

    }
}
