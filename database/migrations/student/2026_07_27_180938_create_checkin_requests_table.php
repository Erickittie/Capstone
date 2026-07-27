<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create the checkin_requests table to store student meeting requests
        Schema::create('checkin_requests', function (Blueprint $table) {
            $table->id(); // unique id for each request

            // The student who made the request
            $table->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete(); // delete request if student is deleted

            // Which class this request belongs to
            $table->foreignId('class_room_id')
                ->constrained('class_rooms')
                ->cascadeOnDelete(); // delete request if class is deleted

            $table->string('reason'); 
            $table->date('preferred_date');
            $table->time('preferred_time'); 
            $table->enum('mode', ['in-person', 'online', 'either']); 
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending'); 
            $table->text('instructor_note')->nullable(); 

            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down(): void
    {
        // Remove the checkin_requests table if migration is rolled back
        Schema::dropIfExists('checkin_requests');
    }
};