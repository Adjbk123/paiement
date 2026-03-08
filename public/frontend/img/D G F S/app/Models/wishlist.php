<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\product;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlists';
    protected $fillable = [
        'user_id',
        'product_id'
    ];
    public function product(): BelongsTo
    {

        return $this->belongsTo(product::class, 'product_id', 'id');
    }
}







