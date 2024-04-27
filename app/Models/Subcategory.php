<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    protected $fillable = [
        'category_id',
        'name',
    ];

    public function show_pro_acc_sub_cate()
    {
        return $this->hasMany('App\Models\Product', 'sub_category_id', 'id');
    }
}
