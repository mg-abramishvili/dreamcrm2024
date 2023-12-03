<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDollarsTable extends Migration
{
    public function up()
    {
        Schema::create('dollars', function (Blueprint $table) {
            $table->id();
            $table->decimal('kurs');
            $table->date('date');
            $table->integer('cb')->default(0);
            $table->integer('additional')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dollars');
    }
}
