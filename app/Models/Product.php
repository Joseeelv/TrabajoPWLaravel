<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    // Nombre exacto de la tabla en la base de datos (mayúsculas en DB-KEBAB-LARAVEL.sql)
    protected $table = 'PRODUCTS';
    protected $primaryKey = 'product_id';
    public $timestamps = false;
    protected $fillable = ['product_name', 'cost', 'stock', 'category', 'img_src'];
}
