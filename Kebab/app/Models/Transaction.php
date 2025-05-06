<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
    protected $primaryKey = 'transaction_id';
    public $timestamps = false;
    protected $fillable = ['replenishment_id', 'transaction_money'];

    public function order() {
        return $this->belongsTo(Order::class);
    }
    
    public function replenishment() {
        return $this->belongsTo(Replenishment::class);
    }
    
}

