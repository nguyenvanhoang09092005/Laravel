<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'slug',
        'description',
        'regular_price',
        'discounted_price',
        'sku',
        'stock_quantity',
        'stock_status',
        'average_rating',
        'review_count',
        'admin_id',
        'category_id',
        'brand_id',
        'attribute_id',
        'product_img',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Quan hệ với model Category
     * Một sản phẩm thuộc về một danh mục.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Quan hệ với model Brand
     * Một sản phẩm thuộc về một thương hiệu.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * Quan hệ với model Attribute
     * Một sản phẩm có một thuộc tính.
     */
    public function attribute()
    {
        return $this->belongsTo(DefaultAttribute::class, 'attribute_id');
    }


    public function product_reviews()
    {
        return $this->hasMany(Product_review::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
