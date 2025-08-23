<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create agriculteurs table if it doesn't exist
        if (!Schema::hasTable('agriculteurs')) {
            Schema::create('agriculteurs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->integer('CIN')->unique();
                $table->string('farm_address');
                $table->string('farm_type');
                $table->timestamps();
            });
            echo "Created agriculteurs table\n";
        } else {
            echo "agriculteurs table already exists\n";
        }

        // Create agent_bna table if it doesn't exist
        if (!Schema::hasTable('agent_bna')) {
            Schema::create('agent_bna', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('employee_id')->unique();
                $table->string('agency_id');
                $table->timestamps();
            });
            echo "Created agent_bna table\n";
        } else {
            echo "agent_bna table already exists\n";
        }

        // Create responses table if it doesn't exist (but it depends on agent_bna and complaints)
        if (!Schema::hasTable('responses')) {
            // First check if the required tables exist
            if (Schema::hasTable('agent_bna') && Schema::hasTable('complaints')) {
                Schema::create('responses', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('complaint_id')->constrained()->onDelete('cascade');
                    $table->foreignId('agent_bna_id')->constrained('agent_bna')->onDelete('cascade');
                    $table->text('message');
                    $table->timestamps();
                });
                echo "Created responses table\n";
            } else {
                echo "Cannot create responses table - required tables (agent_bna or complaints) are missing\n";
            }
        } else {
            echo "responses table already exists\n";
        }
    }

    public function down()
    {
        // Don't drop tables to avoid data loss
    }
};