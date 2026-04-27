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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('business_id');
            $table->dateTime('booking_date');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->boolean('is_no_show')->default(false);
            $table->decimal('total_price', 8, 2)->default(0.00);
            $table->timestamps();
            
            $table->foreign('customer_id')->references('id')->on('customer_profiles')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
