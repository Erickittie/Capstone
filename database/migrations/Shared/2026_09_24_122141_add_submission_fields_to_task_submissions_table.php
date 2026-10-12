<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // submission_text and file_path already exist
        // in the task_submissions table.
    }

    public function down(): void
    {
        // Nothing to reverse.
    }
};