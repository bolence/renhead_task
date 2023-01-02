<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];


    protected $appends = ['full_name'];


    /**
     * Has many relationship with travel payments table
     *
     * @return void
     */
    public function travel_payments()
    {
        return $this->hasMany(TravelPayment::class);
    }

    /**
     * Has many relationship with payments table
     *
     * @return void
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Check if user has type = APPROVER
     *
     * @return boolean
     */
    public function scopeApprover()
    {
        return $this->type == 'APPROVER';
    }


    public function scopeApprovers()
    {
        return $this->whereType('APPROVER')->get();
    }


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
