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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name_ar');
            $table->text('description_en')->nullable()->after('slug');
            $table->text('description_fr')->nullable()->after('description_en');
            $table->text('description_ar')->nullable()->after('description_fr');
            $table->string('icon')->nullable()->after('description_ar');
            $table->boolean('is_active')->default(true)->after('icon');
            $table->integer('sort_order')->default(0)->after('is_active');
            
            $table->index('is_active');
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['slug', 'description_en', 'description_fr', 'description_ar', 'icon', 'is_active', 'sort_order']);
        });
    }
};
