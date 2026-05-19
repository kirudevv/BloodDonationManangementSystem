<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // This completely removes the old trigger from your database schema
        DB::unprepared('DROP TRIGGER IF EXISTS after_donation_update');
    }

    public function down(): void
    {
        // Left empty intentionally because we don't want to recreate the wrong trigger on rollback
    }
};