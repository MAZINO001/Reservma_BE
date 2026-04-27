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
        Schema::table('businesses', function (Blueprint $table) {
            $table->index('is_featured');
            $table->index('status');
            $table->index('city');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('sort_order');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->index('customer_id');
            $table->index('business_id');
            $table->index(['booking_date', 'start_time']);
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->index('rating');
            $table->index(['business_id', 'rating']);
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->unique(['user_id', 'business_id']); // Prevent duplicates
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropIndex(['is_featured', 'status', 'city']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'sort_order']);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex(['customer_id', 'business_id']);
            $table->dropIndex(['booking_date', 'start_time']);
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->dropIndex(['rating']);
            $table->dropIndex(['business_id', 'rating']);
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'business_id']);
        });
    }
};
