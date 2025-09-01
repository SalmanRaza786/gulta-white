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
        Schema::table('product_codes', function (Blueprint $table) {
            $table->enum('is_enable', [1,2])->default(1)->comment('1 yes 2 no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_codes', function (Blueprint $table) {
            //
        });
    }
};
