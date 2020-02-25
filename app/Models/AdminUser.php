<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    public $table ='admin_users';


    protected $fillable = [
      'name','avatar','created_at'
    ];

    protected $hidden = [
      'password','username','remember_token'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class,'id','user_id');
    }

}
