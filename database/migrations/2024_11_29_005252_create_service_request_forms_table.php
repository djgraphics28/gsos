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
        Schema::create('service_request_forms', function (Blueprint $table) {
            $table->id();
            $table->string('requisition_number');
            $table->unsignedBigInteger('building_id');
            $table->unsignedBigInteger('nature_of_service_requested');
            $table->json('service_request_details');
            $table->unsignedBigInteger('service_requestor');
            $table->text('request_message')->nullable();
            $table->unsignedBigInteger('assign_to')->nullable();
            $table->date('date_assigned')->nullable();
            $table->unsignedBigInteger('assign_by')->nullable();
            $table->date('date_inspected')->nullable();
            $table->unsignedBigInteger('inspected_by')->nullable();
            $table->enum('services_to_be_done',['BOM/Estimates','Supply of labor', 'Assistance only'])->nullable();
            $table->enum('status', ['pending', 'in_progress', 'rejected', 'on-hold', 'completed'])->default('pending');
            $table->string('form_code')->nullable();
            $table->string('revision_number')->nullable();
            $table->date('effectivity_date')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_request_forms');
    }
};
