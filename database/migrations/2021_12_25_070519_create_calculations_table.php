<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculationsTable extends Migration
{
    public function up()
    {
        Schema::create('calculations', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id')->nullable();
            $table->integer('catalog_type_id');
            $table->integer('quantity');
            $table->integer('pre_rub')->nullable();
            $table->integer('pre_usd')->nullable();
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->text('comment')->nullable();
            $table->integer('user_id');
            $table->integer('project_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calculations');
    }
}
