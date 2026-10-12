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
    Schema::table('task_submissions', function (Blueprint $table) {
        if (!Schema::hasColumn('task_submissions', 'submission_text')) {
            $table->text('submission_text')
                ->nullable()
                ->after('student_id');
        }

        if (!Schema::hasColumn('task_submissions', 'file_path')) {
            $table->string('file_path')
                ->nullable()
                ->after('submission_text');
        }
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('task_submissions', function (Blueprint $table) {

        if (Schema::hasColumn('task_submissions', 'submission_text')) {
            $table->dropColumn('submission_text');
        }

        if (Schema::hasColumn('task_submissions', 'file_path')) {
            $table->dropColumn('file_path');
        }

    });
}
};
