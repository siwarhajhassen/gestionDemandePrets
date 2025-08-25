<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('agent_bna', function (Blueprint $table) {
            // 1. Remove agency_id column
            if (Schema::hasColumn('agent_bna', 'agency_id')) {
                $table->dropColumn('agency_id');
            }
            
            // 2. Add foreign key constraint to agence_id
            $table->foreign('agence_id')->references('id')->on('agences')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('agent_bna', function (Blueprint $table) {
            // 1. Drop the foreign key constraint
            $table->dropForeign(['agence_id']);
            
            // 2. Re-add agency_id column
            $table->string('agency_id')->nullable();
        });
    }
};