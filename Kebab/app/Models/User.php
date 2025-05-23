<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Manager;
use App\Models\Customer;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false; // Disable timestamps
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'user_id',
        'username',
        'email',
        'password',
        'user_type',
        'img_src',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getUserType()
    {
        return $this->user_type;
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id');
    }

    public function manager()
    {
        return $this->hasOne(Manager::class, 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function reviewsRespondidas()
    {
        return $this->hasMany(Review::class, 'manager_id');
    }

}