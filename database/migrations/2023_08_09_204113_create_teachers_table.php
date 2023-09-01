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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 100);
            $table->string('university', 100);
            $table->string('country', 50);
            $table->string('city', 50);
            $table->string('url')->nullable();
            $table->string('field')->nullable();
            $table->string('email')->nullable();
            $table->boolean('sent')->default(false);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('first_reminder')->nullable();
            $table->dateTime('second_reminder')->nullable();
            $table->dateTime('third_reminder')->nullable();
            $table->string('situation', 250)->nullable();
            $table->string('final', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
