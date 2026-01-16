<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemIngredient extends Model
{
    protected $table = 'ORDER_ITEMS_INGREDIENTS';
    public $timestamps = false;

    protected $fillable = ['order_item_id', 'ingredient_id', 'quantity'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }
}

