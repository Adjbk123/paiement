<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProductImages;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
            'category_id',
            'name',
            'slug',
            'brand',
            'small_description',
            'description',

            'original_price',
            'selling_price',
            'quantity',
            'trending',
            'featured',
            'status',

            'meta_title',
            'meta_keyword',
            'meta_description'
    ];
    public function category()
    {
        return $this->belongsTo(category::class , 'category_id' , 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id' , 'id');
    }
}

















