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
       // Create the votes table to store student PM election votes
        Schema::create('votes', function (Blueprint $table) {
            $table->id(); // unique id for each vote record

            $// The student who cast the vote
            $table->foreignId('voter_id')
                ->constrained('users')
                ->cascadeOnDelete(); // delete vote if student is deleted

            // The student who was voted for
            $table->foreignId('candidate_id')
                ->constrained('users')
                ->cascadeOnDelete(); // delete vote if candidate is deleted

             // Which group this vote belongs to
            $table->unsignedBigInteger('group_id');

            $table->timestamps(); // created_at and updated_at

            // Prevent a student from voting more than once per group
            $table->unique(['voter_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
