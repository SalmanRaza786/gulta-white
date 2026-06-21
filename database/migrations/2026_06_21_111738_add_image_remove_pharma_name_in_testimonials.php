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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('image')->nullable()->default(null)->after('review_message');
            if (Schema::hasColumn('testimonials', 'pharma_name')) {
                $table->dropColumn('pharma_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->string('pharma_name')->nullable()->default(null);
        });
    }
};
