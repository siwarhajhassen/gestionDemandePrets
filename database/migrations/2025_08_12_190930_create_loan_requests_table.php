<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agriculteur_id')->constrained('agriculteurs')->onDelete('cascade');
            $table->decimal('amountRequested', 15, 2);
            $table->string('purpose');
            $table->enum('status', ['DRAFT', 'SUBMITTED', 'IN_REVIEW', 'APPROVED', 'REJECTED', 'INCOMPLETE'])->default('DRAFT');
            $table->timestamp('submissionDate')->nullable();
            $table->timestamp('lastUpdated')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loan_requests');
    }
}
