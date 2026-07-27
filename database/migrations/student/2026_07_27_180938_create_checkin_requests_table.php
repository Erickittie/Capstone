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
        Schema::create('checkin_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('class_room_id')
                ->constrained('class_rooms')
                ->cascadeOnDelete();
            $table->string('reason');
            $table->date('preferred_date');
            $table->time('preferred_time');
            $table->enum('mode', ['in-person', 'online', 'either']);
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->text('instructor_note')->nullable();
            $table->timestamps();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkin_requests');
    }
};
