<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'products'; // lowercase, plural
    protected $fillable = ['product_name', 'img_src', 'category'];
}
