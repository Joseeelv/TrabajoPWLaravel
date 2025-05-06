<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers'; // o 'CUSTOMERS' si tu tabla está en mayúsculas

    protected $fillable = [
        'user_id',
        'customer_address',
        'points',
    ];
}
