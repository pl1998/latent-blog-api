<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //

    protected $table = 'topics';

    protected $fillable = [
        'topic_id',
        'article_id',
        'user_id',
        'to_uid',
        'content',
        'avatar',
        'name',
        'email'
    ];

    /**
     * @param $value
     * 生成随机头像
     */

//    public function setAvatarAttribute($value)
//    {
//        if(preg_match('|^zd[1-9]\d{4,10}@qq\.com$|i',$value)){
//          $value =  explode('@',$value);
//            $this->attributes['avatar'] = sprintf('http://q2.qlogo.cn/headimg_dl?dst_uin=%s&spec=100',$value);
//        }else{
//            $this->attributes['avatar'] = $this->makeGravatar($value);
//        }
//    }

//    public function makeGravatar(string $email, int $size = 120)
//    {
//        $hash = md5($email);
//        return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d=identicon";
//    }

//    public function getAvatarAttribute($value)
//    {
//        if(empty($value)){
//            $value= rand(100000,9999999);
//        }
//
//        return $this->makeGravatar($value);
//    }


    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s',$value)->diffForHumans();
    }



    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

}
