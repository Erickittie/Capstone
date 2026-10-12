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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table -> foreignId('project_id')
            -> constrained('projects')
            -> cascadeOnDelete();
            $table -> foreignId('group_id')
            -> nullable()
            -> constrained('groups')
            -> nullOnDelete();
            $table -> string('title');
            $table -> text('description') -> nullable();
            $table -> integer('points') -> default(0);
            $table -> date('due_date') -> nullable();
            $table -> string('status') -> default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
