<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AboutMeModel extends Model
{
    protected $table = 'about_me';


    public function getContactMeAttribute($value)
    {
        return env('APP_URL').'/storage/'.$value;
    }

    public function getImgUrlAttribute($value)
    {
        return env('APP_URL').'/storage/'.$value;
    }
}
