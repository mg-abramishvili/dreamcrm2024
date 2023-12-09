<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('main_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('usd_kurs');
            $table->date('usd_date');
            $table->integer('usd_cb')->default(0);
            $table->integer('usd_additional')->default(0);
            $table->integer('sborka_arenda');
            $table->integer('sborka_person');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('main_settings');
    }
};
