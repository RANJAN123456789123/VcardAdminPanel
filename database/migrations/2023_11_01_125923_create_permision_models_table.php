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
        Schema::create('permision_models', function (Blueprint $table) {
            $table->id();
            $table->string('module_feature_name');
            $table->string('permission_name');
            $table->enum('permission_status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();
            $table->index('module_feature_name');
            $table->index('permission_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permision_models');
    }
};
