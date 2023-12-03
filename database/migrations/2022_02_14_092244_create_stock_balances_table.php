<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockBalancesTable extends Migration
{
    public function up()
    {
        Schema::create('stock_balances', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_item_id');
            $table->integer('quantity');
            $table->date('date');
            $table->integer('pre_rub')->default(0);
            $table->integer('pre_usd')->default(0);
            $table->integer('price')->default(0);
            $table->decimal('usd_kurs')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_balances');
    }
}
