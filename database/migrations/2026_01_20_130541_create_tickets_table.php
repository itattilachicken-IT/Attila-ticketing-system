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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            // Ticket creator
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Assigned staff (optional)
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Ticket details
            $table->string('title');
            $table->string('help_topic');
            $table->enum('priority', ['low', 'medium', 'high'])->default('low');
            $table->text('description');

            // Status control
            $table->enum('status', ['pending', 'open', 'in_progress', 'closed'])
                ->default('pending');

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
