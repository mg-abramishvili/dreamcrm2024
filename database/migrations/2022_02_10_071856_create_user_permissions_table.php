<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->boolean('calculations_watch')->default(false);
            $table->boolean('calculations_create')->default(false);
            $table->boolean('projects_watch')->default(false);
            $table->boolean('projects_create')->default(false);
            $table->boolean('productions_watch')->default(false);
            $table->boolean('productions_create')->default(false);
            $table->boolean('catalog_watch')->default(false);
            $table->boolean('catalog_create')->default(false);
            $table->boolean('stock_watch')->default(false);
            $table->boolean('stock_create')->default(false);
            $table->boolean('clients_watch')->default(false);
            $table->boolean('clients_create')->default(false);
            $table->boolean('users_watch')->default(false);
            $table->boolean('users_create')->default(false);
            $table->boolean('settings_watch')->default(false);
            $table->boolean('settings_create')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_permissions');
    }
}
