<?php

namespace App\Models;

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
    ];

    protected $casts = [
        'is_show' => 'boolean'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function label()
    {
        return $this->hasMany(Label::class);
    }
}
