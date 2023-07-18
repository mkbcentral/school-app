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
        Schema::table('paiments', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\School::class)->nullable()->after('rate_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paiments', function (Blueprint $table) {
            $table->dropColumn('school_id');
        });
    }
};
