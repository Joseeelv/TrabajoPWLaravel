<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOffers extends Model
{
    protected $table = 'CUSTOMERS_OFFERS';
    public $timestamps = false;

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'offer_id');
    }
}
