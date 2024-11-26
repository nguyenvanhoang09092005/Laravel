<?php

namespace App\Models;

use App\Models\Promotions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shipping_address_id',
        'promotion_id',
        'order_code',
        'total_price_without_discount',
        'total_price',
        'payment_method',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->order_code = 'ORD-' . strtoupper(Str::padLeft('0', 5, '0'));
        });

        static::created(function ($order) {
            $order->order_code = 'ORD-' . strtoupper(Str::padLeft($order->id, 5, '0'));
            $order->save();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotions::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(ShippingAddress::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
