<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contact_us_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ToEmail');
            $table->string('fromEmail');
            $table->string('subject');
            $table->unsignedBigInteger('phone_number');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us_models');
    }
};
