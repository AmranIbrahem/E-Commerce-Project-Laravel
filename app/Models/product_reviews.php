<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_reviews extends Model
{
    use HasFactory;
    protected $table = 'product_reviews';

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
    ];

    // public function users()
    // {
    //     return $this->belongsToMany('App\Models\User')->withTimestamps();
    // }

    // public function product()
    // {
    //     return $this->belongsTo('App\Models\Product');
    // }

}
