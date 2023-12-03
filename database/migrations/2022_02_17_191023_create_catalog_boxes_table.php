<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogBoxesTable extends Migration
{
    public function up()
    {
        Schema::create('catalog_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sborka_days')->nullable();
            $table->integer('sborka_persons')->nullable();
            $table->integer('sborka')->nullable();
            $table->integer('marzha')->nullable();
            $table->integer('pre_rub')->default(0);
            $table->integer('pre_usd')->default(0);
            $table->integer('price')->default(0);
            $table->integer('length')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->longText('description')->nullable();
            $table->longText('manager_description')->nullable();
            $table->longtext('gallery')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('catalog_boxes');
    }
}
