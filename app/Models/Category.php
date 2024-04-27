<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    public function productt()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'id')->select(['id', 'name','price','main_image','category_id']);
    }

    public function getCatgo()
    {
        return $this->belongsToMany(
            'app\Models\Brand',
            'brand_categories',
            'brand_id',
            'category_id',
            'id',
        );
    }

    public function get_sub_Cate()
    {
        return $this->hasMany(
            'App\Models\Subcategory',
            'category_id',
            'id'
        );
    }
}
