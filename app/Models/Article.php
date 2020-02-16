<?php

namespace App\Models;

use App\Models\AdminUser;
use Illuminate\Database\Eloquent\Model;

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
        'is_show',
        'user_id',
        'category_id'
    ];

    protected $casts = [
        'is_show' => 'boolean'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     *  获取标签数组
     * @param $value
     * @return array
     */

   public function getLabelAttributes($value)
   {
       return explode(',', $value);
   }

    public function setLabelAttribute($value)
    {
        $this->attributes['Label'] = implode(',', $value);
    }

   public function admin_user()
   {
       return $this->hasOne(AdminUser::class,'id','user_id');
   }

}
