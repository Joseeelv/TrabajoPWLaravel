<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model {
    protected $primaryKey = 'ingredient_id';
    public $timestamps = false;
    protected $fillable = ['ingredient_name', 'cost', 'stock', 'img_src'];
}
