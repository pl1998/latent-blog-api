<?php

namespace App\Models;

use App\Models\AdminUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    //

    protected $fillable = [
        'title',
        'cover_img',
        'description',
        'content',
        'review_count',
        'browse_count',
        'label',
        'created_at',
        'updated_at',
        'status',
        'user_id',
        'category_id',
        'slug',
        'stick'
    ];

    public function visitor_registry()
    {
        return $this->hasMany(VisitorRegistry::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     *  获取标签数组
     * @param $value
     * @return array
     */

   public function getFullNameAttribute()
   {
       $labels = explode(',', $this->label);
       $label_list = [];
       foreach ($labels as $key=> $label ) {
           $labelObj = Label::query()->find($label);
           $label_list[$key]['id'] = $label;
           $label_list[$key]['label_name'] = $labelObj->label_name;
           $label_list[$key]['color'] = $labelObj->color;
       }
      return $label_list;
   }

    public function setLabelAttribute($value)
    {
        $this->attributes['Label'] = implode(',', $value);
    }

   public function admin_user()
   {
       return $this->hasOne(AdminUser::class,'id','user_id');
   }

   public function getCoverImgAttribute($value)
   {
       return env('APP_URL').'/storage/'.$value;
   }
    public function getSlugAttribute($value)
    {
        if(!$value){
            return md5($this->title);
        }else{
            return $value;
        }

    }

   public function getCreatedAtAttribute($value)
   {
       return Carbon::createFromFormat('Y-m-d H:i:s',$value)->diffForHumans();
   }

   public function visitor_registries()
   {
       return $this->hasMany(VisitorRegistry::class,'art_id','id');
   }










}
