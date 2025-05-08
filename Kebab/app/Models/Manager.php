<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $table = 'managers';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'salary',
        'employee',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function respuestas()
    {
        return $this->hasMany(Review::class, 'manager_id');
    }
}
