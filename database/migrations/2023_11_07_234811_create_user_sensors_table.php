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
        Schema::create('user_sensors', function (Blueprint $table) {
            $table->id();
            $table->json("value");
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger("type_id");
            $table->timestamp("time");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sensors');
    }
};
