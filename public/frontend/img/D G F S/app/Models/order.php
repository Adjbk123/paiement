<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Orderitem;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable =  [
        'user_id',
        'tracking_no',
        'fullname',
        'email',
        'phone',
        'pincode',
        'address',
        'status_message',
        'payement_mode',
        'payement_id'

    ];

     public function orderItems() : HasMany
     {
         return $this->hasMany(Orderitem::class, 'order_id' , 'id');
     }
}
