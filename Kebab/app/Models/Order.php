<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'ORDERS';
    public $timestamps = false;
    protected $fillable = ['user_id', 'order_date', 'order_status'];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}
