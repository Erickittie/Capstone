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
       Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voter_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('candidate_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('group_id');
            $table->timestamps();

            // One student can only vote once per group
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
