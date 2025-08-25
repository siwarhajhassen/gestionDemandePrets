<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('agriculteurs', function (Blueprint $table) {
            // Check if column already exists
            if (!Schema::hasColumn('agriculteurs', 'agence_id')) {
                $table->foreignId('agence_id')->constrained()->onDelete('cascade');
            } else {
                // If column exists but doesn't have foreign key constraint, add it
                $table->foreign('agence_id')->references('id')->on('agences')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('agriculteurs', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['agence_id']);
            
            // Then drop column (only if you want to remove it completely on rollback)
            // $table->dropColumn('agence_id');
        });
    }
};