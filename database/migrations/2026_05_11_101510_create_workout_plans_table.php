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
    Schema::create('workout_plans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('trainer_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('member_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->text('description')->nullable();
        $table->enum('difficulty', ['beginner', 'intermediate', 'advanced']);
        $table->date('start_date');
        $table->date('end_date');
        $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_plans');
    }
};
