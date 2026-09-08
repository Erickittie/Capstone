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
        Schema::create('task_submissions', function (Blueprint $table) {
            $table->id();
            $table -> foreignId('task_id')
            -> constrained('tasks')
            -> cascadeOnDelete();
            $table -> foreignId('student_id')
            -> constrained('users')
            -> cascadeOnDelete();
            $table -> string('status') -> default('Pending');
            $table -> timestamp('submitted_at') -> nullable();
            $table -> timestamp('approved_at') -> nullable();
            $table -> foreignId('approved_by')
            -> nullable()
            -> constrained('users')
            -> nullOnDelete();
            $table -> text('feedback') -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_submissions');
    }
};
