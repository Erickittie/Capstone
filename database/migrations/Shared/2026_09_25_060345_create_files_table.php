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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_room_id')
            ->constrained('class_rooms')
            ->cascadeOnDelete();
            $table->foreignId('group_id')
            ->constrained('groups')
            ->cascadeOnDelete();
            $table->foreignId('project_id')
            ->nullable()
            ->constrained('projects')
            ->cascadeOnDelete();
            $table->foreignId('folder_id')
            ->nullable()
            ->constrained('file_folders')
            ->cascadeOnDelete();
            $table->foreignId('uploaded_by')
            ->constrained('users')
            ->cascadeOnDelete();
            $table->string('name');
            $table->string('original_name');
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('file_size')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
