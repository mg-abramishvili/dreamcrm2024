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
            $table->boolean('users_watch')->default(false);
            $table->boolean('users_create')->default(false);
            $table->boolean('clients_watch')->default(false);
            $table->boolean('clients_create')->default(false);
            $table->boolean('calculations_watch')->default(false);
            $table->boolean('calculations_create')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_permissions');
    }
}
