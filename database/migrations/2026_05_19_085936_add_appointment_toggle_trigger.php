<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_donation_toggle_appointment');

        DB::unprepared("
            CREATE TRIGGER after_donation_toggle_appointment
            AFTER UPDATE ON donations
            FOR EACH ROW
            BEGIN
                IF NEW.status = 'Approved' AND OLD.status <> 'Approved' THEN
                    INSERT INTO appointments (user_id, hospital_id, donation_id, status, created_at, updated_at)
                    VALUES (NEW.user_id, NEW.hospital_id, NEW.donation_id, 'Scheduled', NOW(), NOW());
                ELSEIF NEW.status = 'Screening' AND OLD.status = 'Approved' THEN
                    DELETE FROM appointments 
                    WHERE donation_id = NEW.donation_id 
                    AND status = 'Scheduled';
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_donation_toggle_appointment');
    }
};