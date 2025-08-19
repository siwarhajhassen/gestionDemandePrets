<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained('agent_b_n_a_s')->onDelete('cascade');
            $table->foreignId('loan_request_id')->constrained('loan_requests')->onDelete('cascade');
            $table->text('content');
            $table->enum('visibility', ['INTERNAL', 'SHARED_WITH_APPLICANT'])->default('INTERNAL');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
