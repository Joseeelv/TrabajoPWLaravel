<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Replenishment extends Model {
    protected $primaryKey = 'replenishment_id';
    public $timestamps = false;
    protected $fillable = ['manager_id', 'replenishment_date', 'ingredient_id', 'product_id', 'quantity'];
}
