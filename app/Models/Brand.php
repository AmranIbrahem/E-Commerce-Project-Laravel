<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'name',
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getBrandCat()
    {
        return $this->belongsToMany(
            'app\Models\Catgory',
            'brand_catgories',
            'brand_id',
            'category_id',
            'id',
        );
    }
}
