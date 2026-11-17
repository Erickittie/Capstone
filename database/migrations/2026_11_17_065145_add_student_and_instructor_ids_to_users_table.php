<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Both columns already exist in the users table.
        // No changes are needed.
    }

    public function down(): void
    {
        // Keep the existing columns and user data.
    }
};