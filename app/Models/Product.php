<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'main_image',
        'details',
        'quantity',
        'status',
        'brand_id',
        'category_id',
        'sub_category_id',
        'average_rating'
    ];

    public function catgory()
    {
        return $this->belongsTo(Catgory::class, 'category_id');
    }

    public function imageProduct()
    {
        return $this->hasMany('App\Models\Image', 'product_id', 'id');
    }

    public function carts()
    {
    return $this->hasMany('App\Models\Cart');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\product_reviews');
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

}
