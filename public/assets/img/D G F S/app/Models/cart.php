<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\relations\BelongsTo;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $table ="carts";
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];
    
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id' , 'id');
    } 

}
