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
        Schema::table('services', function (Blueprint $table) {
            $table->string('category')->nullable()->after('is_active');
            $table->text('requirements')->nullable()->after('category');
            
            $table->text('description_en')->nullable()->change();
            $table->text('description_fr')->nullable()->change();
            $table->text('description_ar')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['category', 'requirements']);
        });
    }
};
