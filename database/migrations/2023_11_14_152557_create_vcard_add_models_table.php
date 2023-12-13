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
        Schema::create('vcard_add_models', function (Blueprint $table) {
            $table->id();
            $table->string('vcard_id')->nullable()->default(NULL);
            $table->string('userid')->nullable()->default(NULL);
            $table->string('nfc_id')->nullable()->default(NULL);
            $table->string('preview_url')->nullable()->default(NULL);
            $table->enum('vcard_status', ['active', 'inactive'])->default('active')->default(NULL);
            $table->enum('table_status', ['1', '0'])->default('0');
            $table->string('qr_code')->nullable()->default(NULL);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vcard_add_models');
    }
};
