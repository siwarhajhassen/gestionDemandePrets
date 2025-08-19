<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_request_id')->constrained('loan_requests')->onDelete('cascade');
            $table->string('fileName');
            $table->string('fileType');
            $table->string('storagePath');
            $table->bigInteger('size');
            $table->enum('type', ['ID_CARD', 'BANK_STATEMENT', 'TAX_CERT', 'LAND_REGISTRATION']);
            $table->timestamp('uploadedAt')->useCurrent();
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('set null')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
