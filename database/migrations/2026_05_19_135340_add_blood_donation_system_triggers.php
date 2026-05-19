<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // --------------------------------------------------------
        // TRIGGER 1: after_appointment_completed (On appointments table)
        // --------------------------------------------------------
        DB::unprepared("DROP TRIGGER IF EXISTS `after_appointment_completed`");
        
        DB::unprepared("
            CREATE TRIGGER `after_appointment_completed` 
            AFTER UPDATE ON `appointments` 
            FOR EACH ROW 
            BEGIN 
                -- Scenario: Appointment is marked as Completed 
                IF NEW.status = 'Completed' AND OLD.status <> 'Completed' THEN 
                    INSERT INTO inventory (donation_id, blood_type, blood_components, status, collection_date, expiry_date, created_at, updated_at) 
                    SELECT donation_id, blood_type, blood_components, 'Available', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 42 DAY), NOW(), NOW() 
                    FROM donation 
                    WHERE donation_id = NEW.donation_id; 

                -- Scenario: Appointment was Completed but staff moved it back
                ELSEIF NEW.status <> 'Completed' AND OLD.status = 'Completed' THEN 
                    DELETE FROM inventory WHERE donation_id = NEW.donation_id; 
                END IF; 
            END
        ");

        // --------------------------------------------------------
        // TRIGGER 2: after_donation_toggle_appointment (On donation table)
        // --------------------------------------------------------
        DB::unprepared("DROP TRIGGER IF EXISTS `after_donation_toggle_appointment`");

        DB::unprepared("
            CREATE TRIGGER `after_donation_toggle_appointment` 
            AFTER UPDATE ON `donation` 
            FOR EACH ROW 
            BEGIN
                -- SCENARIO A: Status changed to 'Approved' -> Create Appointment
                IF NEW.status = 'Approved' AND OLD.status <> 'Approved' THEN
                    INSERT INTO appointments (user_id, hospital_id, donation_id, status, created_at, updated_at)
                    VALUES (NEW.user_id, NEW.hospital_id, NEW.donation_id, 'Scheduled', NOW(), NOW());

                -- SCENARIO B: Status changed back to 'Screening' -> Remove Scheduled Appointment
                ELSEIF NEW.status = 'Screening' AND OLD.status = 'Approved' THEN
                    DELETE FROM appointments 
                    WHERE donation_id = NEW.donation_id 
                    AND status = 'Scheduled';
                END IF;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS `after_appointment_completed`");
        DB::unprepared("DROP TRIGGER IF EXISTS `after_donation_toggle_appointment`");
    }
};