<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    public $table ='admin_users';

    public function article()
    {
        return $this->belongsTo(Article::class,'id','user_id');
    }
}
