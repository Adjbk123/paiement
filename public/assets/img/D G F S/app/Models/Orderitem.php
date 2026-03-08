<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
            'order_id',
            'product_id',
            'quantity',
            'price'
    ];

    public function product(): BelongsTo
    {
        return $this->BelongsTo(Product::class,'product_id' , 'id');
    }

}
