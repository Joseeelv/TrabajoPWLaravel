<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'CUSTOMERS';
    public $timestamps = false; 
    protected $fillable = [
        'user_id',
        'customer_address',
        'points',
    ];
}
