<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('loan_requests', function (Blueprint $table) {
            $table->integer('loan_duration')->nullable()->after('purpose');
            $table->string('farm_type')->nullable()->after('loan_duration');
            $table->decimal('land_size', 10, 2)->nullable()->after('farm_type');
            $table->text('project_description')->nullable()->after('land_size');
            $table->date('expected_start_date')->nullable()->after('project_description');
            $table->date('expected_completion_date')->nullable()->after('expected_start_date');
            $table->text('additional_notes')->nullable()->after('expected_completion_date');
        });
    }

    public function down()
    {
        Schema::table('loan_requests', function (Blueprint $table) {
            $table->dropColumn([
                'loan_duration',
                'farm_type',
                'land_size',
                'project_description',
                'expected_start_date',
                'expected_completion_date',
                'additional_notes'
            ]);
        });
    }
};