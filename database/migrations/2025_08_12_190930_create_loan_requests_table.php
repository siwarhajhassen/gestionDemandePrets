<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agriculteur_id')->constrained()->onDelete('cascade');
            $table->decimal('amount_requested', 15, 2);
            $table->string('purpose');
            $table->enum('loan_status', ['draft', 'submitted', 'pending', 'approved', 'rejected', 'under_review'])->default('draft');
            $table->timestamp('submission_date')->nullable();
            $table->timestamp('last_updated')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loan_requests');
    }
};