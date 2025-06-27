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

            // Fields that should only be 0 or 1 with default 0
            $table->boolean('absent')->default(0);
            $table->boolean('ed')->default(0);
            $table->boolean('ld')->default(0);
            $table->boolean('sick_in')->default(0);
            $table->boolean('sick_out')->default(0);
            $table->boolean('permission')->default(0);
            $table->boolean('centry')->default(0);
            $table->boolean('special_duty')->default(0);
            $table->boolean('pass')->default(0);
            $table->boolean('guard')->default(0);
            //
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
