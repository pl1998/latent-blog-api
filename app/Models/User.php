<?php

namespace App\Models;

use Auth;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;


class User extends Authenticatable implements MustVerifyEmailContract, JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','github_name','github_id','bound_oauth'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setAvatarAttributes($value)
    {
        if(preg_match('|^[1-9]\d{4,10}@qq\.com$|',$this->email)){
            $array = explode('@',$this->email);
            $this->attributes['avatar'] = "http://q1.qlogo.cn/g?b=qq&nk=$array[0]&s=100";
        }else{
            $this->attributes['avatar'] = env('APP_URL').'public/images/avatar_github'.rand(1,7).'jpg';
        }
    }

    public function getAvatarAttribute($value)
    {
        if(empty($value)){
            if(preg_match('|^[1-9]\d{4,10}@qq\.com$|',$this->email)){
                $array = explode('@',$this->email);
                return "http://q1.qlogo.cn/g?b=qq&nk=$array[0]&s=100";
            }else{
                return $value;
            }
        }else{
            if(preg_match('|^[1-9]\d{4,10}@qq\.com$|',$this->email)){
                $array = explode('@',$this->email);
                return "http://q1.qlogo.cn/g?b=qq&nk=$array[0]&s=100";
            }else{
                return $value;
            }
        }

    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getUserInfo($uid,$filed)
    {
        $this->where($filed,$uid)->find();
    }


    public function topic()
    {
        return $this->hasOne('App\Models\Topic','id','user_id');
    }


}
