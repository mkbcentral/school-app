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
        Schema::table('scolary_years', function (Blueprint $table) {
            $table->boolean('is_last_year')->after('active')->default(false);
            $table->boolean('is_old_year')->after('is_last_year')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scolary_years', function (Blueprint $table) {
            $table->dropColumn('is_last_year');
            $table->dropColumn('is_old_year');
        });
    }
};
