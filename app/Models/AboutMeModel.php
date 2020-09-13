<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AboutMeModel extends Model
{
    protected $table = 'about_me';

    public function getContactMeAttribute($value)
    {
        if(empty(env('APP_URL'))){
            return 'https://api.pltrue.top/storage/'.$value;
        }else{
            return env('APP_URL').'/storage/'.$value;
        }
    }

    public function getImgUrlAttribute($value)
    {
        if(empty(env('APP_URL'))){
            return 'https://api.pltrue.top/storage/'.$value;
        }else{
            return env('APP_URL').'/storage/'.$value;
        }
    }
}
