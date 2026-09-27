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
        Schema::create('file_folders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_room_id')
            -> constrained('class_rooms')
            -> cascadeOnDelete();
            $table->foreignId('group_id')
            -> constrained('groups')
            -> cascadeOnDelete();
            $table->foreignId('project_id')
            ->nullable()
            ->constrained('projects')
            ->cascadeOnDelete();
            $table->foreignId('parent_id')
            ->nullable()
            ->constrained('file_folders')
            ->cascadeOnDelete();
            $table->string('name');
            $table->foreignId('created_by')
            ->constrained('users')
            ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_folders');
    }
};
