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
        Schema::table('student_responsables', function (Blueprint $table) {
            $table->renameColumn('name','name_responsable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_responsables', function (Blueprint $table) {
            $table->renameColumn('name_responsable','name');
        });
    }
};
