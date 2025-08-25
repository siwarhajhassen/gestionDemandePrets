<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Temporarily disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Schema::table('loan_requests', function (Blueprint $table) {
            // Check if column already exists
            if (!Schema::hasColumn('loan_requests', 'agence_id')) {
                // Add column as nullable first
                $table->foreignId('agence_id')->nullable()->constrained()->onDelete('cascade');
            } else {
                // Make sure the column is nullable before adding foreign key
                $table->unsignedBigInteger('agence_id')->nullable()->change();
            }
        });
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Now update existing records to use valid agence_id
        $this->fixAgenceIds();
        
        // Finally, make the column not nullable and add proper foreign key
        Schema::table('loan_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('agence_id')->nullable(false)->change();
            $table->foreign('agence_id')->references('id')->on('agences')->onDelete('cascade');
        });
    }
    
    protected function fixAgenceIds()
    {
        // Get the first agence ID to use as default
        $defaultAgenceId = DB::table('agences')->value('id');
        
        if (!$defaultAgenceId) {
            // Create a default agence if none exists
            $defaultAgenceId = DB::table('agences')->insertGetId([
                'code' => 'DEFAULT',
                'name' => 'Default Agency',
                'address' => 'Default Address',
                'city' => 'Default City',
                'phone' => '000-000-0000',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // Update records with invalid or null agence_id
        DB::table('loan_requests')
            ->whereNull('agence_id')
            ->orWhereNotIn('agence_id', DB::table('agences')->pluck('id'))
            ->update(['agence_id' => $defaultAgenceId]);
    }

    public function down()
    {
        Schema::table('loan_requests', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['agence_id']);
            
            // Then make column nullable again
            $table->unsignedBigInteger('agence_id')->nullable()->change();
        });
    }
};