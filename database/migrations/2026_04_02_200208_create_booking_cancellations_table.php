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
        Schema::create('booking_cancellations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("booking_id");
            $table->unsignedBigInteger("cancelled_by");
            $table->text("reason");
            $table->timestamp("cancelled_at");
            $table->timestamps();
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('cancelled_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_cancellations');
    }
};
