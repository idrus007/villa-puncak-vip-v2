<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'villa_id',
        'payment_method_id',
        'booking_code',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'identity_number',
        'check_in_date',
        'check_out_date',
        'duration',
        'total_price',
        'paid_amount',
        'is_paid',
        'status',
        'status_bayar',
        'payment_proof',
    ];

    public function villa():BelongsTo
    {
        return $this->belongsTo(Villa::class);
    }

    public function payment_method():BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            $today = now()->format('Ymd'); // tanggal hari ini: 20250417

            $startOfDay = now()->startOfDay();
            $endOfDay = now()->endOfDay();

            $lastOrder = self::whereBetween('created_at', [$startOfDay, $endOfDay])
                ->orderBy('id', 'desc')
                ->first();

            $number = 1;

            if ($lastOrder) {
                // Ambil nomor terakhir dari booking_code, misal dari INV-20250417-005
                $lastNumber = (int) substr($lastOrder->booking_code, -3);
                $number = $lastNumber + 1;
            }

            $order->booking_code = 'INV-' . $today . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
}
