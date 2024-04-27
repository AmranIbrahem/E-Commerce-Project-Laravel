<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand_Catgory extends Model
{
    use HasFactory;

    protected $table = 'brand_catgories';

    protected $fillable = [
        'brand_id',
        'category_id',
    ];
}
