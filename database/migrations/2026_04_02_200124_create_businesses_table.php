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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->text('description_en')->nullable();
            $table->text('description_fr')->nullable();
            $table->text('description_ar')->nullable();
            $table->enum('gender_target', ['male', 'female', 'all'])->default('all');
            $table->string('city')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('slug')->unique();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->decimal('rating_avg', 3, 2)->default(0.00);
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owner_profiles')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
