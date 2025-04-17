<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('villa_id')->constrained()->cascadeOnDelete();
            $table->foreignId('payment_method_id')->constrained()->cascadeOnDelete();
            $table->string('booking_code')->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('customer_address');
            $table->string('identity_number');
            $table->dateTime('check_in_date');
            $table->dateTime('check_out_date');
            $table->unsignedBigInteger('duration');
            $table->unsignedBigInteger('total_price');
            $table->unsignedBigInteger('paid_amount')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->enum('status', ['available', 'booked'])->default('booked');
            $table->enum('status_bayar', ['dp', 'full']);
            $table->string('payment_proof');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_transactions');
    }
};
