<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        // Trigger for Creating Appointment
        DB::unprepared('
            CREATE TRIGGER after_donation_insert
            AFTER INSERT ON donation
            FOR EACH ROW
            BEGIN
                INSERT INTO appointments (user_id, hospital_id, donation_id, status, created_at, updated_at)
                VALUES (NEW.user_id, NEW.hospital_id, NEW.donation_id, "Scheduled", NOW(), NOW());
            END
        ');

        // Trigger for Adding to Inventory
        DB::unprepared('
            CREATE TRIGGER after_appointment_completed
            AFTER UPDATE ON appointments
            FOR EACH ROW
            BEGIN
                IF NEW.status = "Completed" AND OLD.status <> "Completed" AND NEW.donation_id IS NOT NULL THEN
                    INSERT INTO inventory (donation_id, blood_type, blood_components, status, expiry_date, collection_date, created_at, updated_at)
                    SELECT donation_id, blood_type, blood_components, "Available", DATE_ADD(CURDATE(), INTERVAL 42 DAY), CURDATE(), NOW(), NOW()
                    FROM donation WHERE donation_id = NEW.donation_id;
                END IF;
            END
        ');
    }

    public function down(): void {
        DB::unprepared('DROP TRIGGER IF EXISTS after_donation_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS after_appointment_completed');
    }
};