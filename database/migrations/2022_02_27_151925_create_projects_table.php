<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('user_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('end_client_id')->nullable();
            $table->string('status');
            $table->string('end_date')->nullable();
            $table->text('comment')->nullable();
            $table->string('delivery_address')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
