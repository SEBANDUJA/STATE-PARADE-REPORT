<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('s_id')->unique();
            $table->string('name');
            $table->string('gender');
            $table->string('company');
            $table->float('ed');
            $table->float('ld');
            $table->boolean('sick_in');
            $table->boolean('sick_out');
            $table->float('permission');
            $table->boolean('centry');
            $table->boolean('special_duty');
            $table->float('pass');
            $table->char('guard');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
