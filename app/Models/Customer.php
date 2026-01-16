<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'CUSTOMERS';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'customer_address',
        'points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
