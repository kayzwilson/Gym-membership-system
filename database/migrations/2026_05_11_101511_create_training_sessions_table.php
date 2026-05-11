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
    Schema::create('training_sessions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('trainer_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('member_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->text('notes')->nullable();
        $table->date('session_date');
        $table->time('start_time');
        $table->time('end_time');
        $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_sessions');
    }
};
