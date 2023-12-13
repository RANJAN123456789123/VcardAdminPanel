<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleModelsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('role_models', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->enum('admin_create', ['active', 'inactive'])->default('inactive');
            $table->enum('admin_show', ['active', 'inactive'])->default('inactive');
            $table->enum('admin_edit', ['active', 'inactive'])->default('inactive');
            $table->enum('admin_delete', ['active', 'inactive'])->default('inactive');
            $table->enum('user_create', ['active', 'inactive'])->default('inactive');
            $table->enum('user_edit', ['active', 'inactive'])->default('inactive');
            $table->enum('user_show', ['active', 'inactive'])->default('inactive');
            $table->enum('user_delete', ['active', 'inactive'])->default('inactive');
            $table->enum('permission_create', ['active', 'inactive'])->default('inactive');
            $table->enum('permission_edit', ['active', 'inactive'])->default('inactive');
            $table->enum('permission_show', ['active', 'inactive'])->default('inactive');
            $table->enum('permission_delete', ['active', 'inactive'])->default('inactive');
            $table->enum('role_create', ['active', 'inactive'])->default('inactive');
            $table->enum('role_edit', ['active', 'inactive'])->default('inactive');
            $table->enum('role_show', ['active', 'inactive'])->default('inactive');
            $table->enum('role_delete', ['active', 'inactive'])->default('inactive');

            $table->enum('vcard_create', ['active', 'inactive'])->default('inactive');
            $table->enum('vcard_edit', ['active', 'inactive'])->default('inactive');
            $table->enum('vcard_show', ['active', 'inactive'])->default('inactive');
            $table->enum('vcard_delete', ['active', 'inactive'])->default('inactive');

            $table->enum('vcardtemplate_create', ['active', 'inactive'])->default('inactive');
            $table->enum('vcardtemplate_edit', ['active', 'inactive'])->default('inactive');
            $table->enum('vcardtemplate_show', ['active', 'inactive'])->default('inactive');
            $table->enum('vcardtemplate_delete', ['active', 'inactive'])->default('inactive');

            $table->enum('role_status', ['active', 'inactive'])->default('inactive');
            $table->enum('table_status', ['1', '0'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('role_models');
    }
}
