<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('agriculteurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('CIN')->unique();
            $table->string('farm_address');
            $table->string('farm_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agriculteurs');
    }
};