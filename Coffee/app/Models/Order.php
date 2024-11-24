<?php

namespace App\Models;

use App\Models\Promotions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'status',
        'total_price',
        'shipping_address',
        'phone',
        'payment_method',
        'promotion_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotions::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
