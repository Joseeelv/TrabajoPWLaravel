<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $table = 'OFFERS';
    protected $primaryKey = 'offer_id';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'prod_id');
    }

    public function customers()
    {
        return $this->belongsToMany(User::class, 'CUSTOMERS_OFFERS', 'offer_id', 'user_id')
                    ->withPivot('activation_date');
    }
}
