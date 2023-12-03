<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockItemsTable extends Migration
{
    public function up()
    {
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('comment')->nullable();
            $table->integer('category_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_items');
    }
}
