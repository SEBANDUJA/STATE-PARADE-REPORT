<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('daily_totals', function (Blueprint $table) {
            $table->id();
            $table->date('report_date')->unique();
            $table->integer('present');
            $table->integer('absent');
            $table->integer('sick_in');
            $table->integer('sick_out');
            $table->integer('ed');
            $table->integer('ld');
            $table->integer('pass');
            $table->integer('permission');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_totals');
    }
};
