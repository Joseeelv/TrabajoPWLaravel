<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $primaryKey = 'product_id';
    public $timestamps = false;
    protected $fillable = ['product_name', 'cost', 'stock', 'category', 'img_src'];
}
