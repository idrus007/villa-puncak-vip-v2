<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Villa extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'address',
        'price',
    ];

    public function facilities():HasMany
    {
        return $this->hasMany(Facility::class);
    }

    public function paymentMethods():HasMany
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function bookingTransactions():HasMany
    {
        return $this->hasMany(BookingTransaction::class);
    }
}
