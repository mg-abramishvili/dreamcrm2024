<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CalculationCatalogItemTable extends Migration
{
    public function up()
    {
        Schema::create('calculation__catalog_item', function (Blueprint $table) {
            $table->id();
            $table->integer('calculation_id');
            $table->integer('catalog_item_id');
            $table->integer('pre_rub');
            $table->integer('pre_usd');
            $table->integer('price');
        });
    }

    public function down()
    {
        Schema::dropIfExists('calculation__catalog_item');
    }
}
