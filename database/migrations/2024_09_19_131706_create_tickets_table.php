<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workflow_id')->constrained('workflows'); // Connects to the workflow
            $table->string('ticket_number')->unique(); // Unique ticket identifier
            $table->json('form_data'); // Dynamic form data tied to this ticket
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open'); // Ticket status
            $table->enum('type', ['request', 'repair', 'borrow'])->default('request');
            $table->enum('priority', ['low', 'medium', 'high'])->default('low');
            // Foreign keys
            $table->foreignId('requested_by')->constrained('users'); // User who made the request
            $table->foreignId('assigned_to')->nullable()->constrained('users'); // User the ticket is assigned to
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
