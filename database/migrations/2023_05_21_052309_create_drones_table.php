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
        Schema::create('drones', function (Blueprint $table) {
            $table->id();
            $table->string('drone_name');
            $table->string('sensor');
            $table->string('playoad_capacity');
            $table->string('batter_life');
            $table->unsignedBigInteger('famer_id')->unsigned();
            $table->foreign('famer_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->unsignedBigInteger('map_id')->unsigned();
            $table->foreign('map_id')->references('id')->on('maps')->onDelete('cascade');
            $table->unsignedBigInteger('drone_type_id')->unsigned();
            $table->foreign('drone_type_id')->references('id')->on('drone_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drones');
    }
};
