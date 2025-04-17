<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'villa_id',
        'bank_name',
        'account_number',
    ];

    public function villa():BelongsTo
    {
        return $this->belongsTo(Villa::class);
    }

    public function bookingTransactions():HasMany
    {
        return $this->hasMany(BookingTransaction::class);
    }
}
