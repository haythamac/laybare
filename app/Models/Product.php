<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_name',
        'product_sku',
        'product_category',
        'product_category_id',
        'product_description',
        'product_image',
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}