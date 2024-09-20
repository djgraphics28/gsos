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
        Schema::create('supply_equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('category', ['supply','equipment']);
            $table->integer('quantity');
            $table->string('unit');
            $table->unsignedBigInteger('building_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_equipment');
    }
};
