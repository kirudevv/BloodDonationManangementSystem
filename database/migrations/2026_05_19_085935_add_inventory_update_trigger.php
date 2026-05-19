<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop if exists to avoid migration crash loops
        DB::unprepared('DROP TRIGGER IF EXISTS after_donation_completed');

        DB::unprepared("
            CREATE TRIGGER after_donation_completed
            AFTER UPDATE ON donations
            FOR EACH ROW
            BEGIN
                IF NEW.status = 'Completed' AND OLD.status != 'Completed' THEN
                    UPDATE blood_inventories 
                    SET volume_ml = volume_ml + 450
                    WHERE blood_type = (SELECT blood_type FROM donors WHERE id = NEW.donor_id);
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_donation_update');
    }
};