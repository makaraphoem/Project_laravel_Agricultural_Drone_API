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
        Schema::create('indructions', function (Blueprint $table) {
            $table->id();
            $table->string('charge_the_batteries');
            $table->string('download_the_app');
            $table->string('find_a_safe_location');
            $table->string('take_off_and_fly');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indructions');
    }
};
