<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'ORDER_ITEMS';
    protected $primaryKey = 'product_id';
    public $timestamps = false;
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function ingredients()
    {
        return $this->hasMany(OrderItemIngredient::class, 'order_item_id');
    }
}
