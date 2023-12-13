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
        Schema::create('v_card_template_models', function (Blueprint $table) {
            $table->id();
            $table->string('template_name')->nullable();
            $table->string('template_photo')->nullable();
            $table->string('template_url')->nullable();
            $table->bigInteger('used_count')->nullable();
            $table->text('templatehtmlCss')->nullable();
            $table->enum('Vtable_status', ['1', '0'])->default('0');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_card_template_models');
    }
};
