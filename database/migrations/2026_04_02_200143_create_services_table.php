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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("business_id");
            $table->string("name_en");
            $table->string("name_fr");
            $table->string("name_ar");
            $table->text("description_en");
            $table->text("description_fr");
            $table->text("description_ar");
            $table->decimal('price', 8, 2);
            $table->integer('duration');
            $table->integer("sort_order");
            $table->boolean("is_active");
            $table->timestamps();
            
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
