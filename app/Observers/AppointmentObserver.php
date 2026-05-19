<?php

namespace App\Observers;

use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentObserver
{
    /**
     * Handle the Appointment "updated" event.
     */
    public function updated(Appointment $appointment): void
    {
        $oldStatus = $appointment->getOriginal('status');
        $newStatus = $appointment->status;

        // SCENARIO 1: Appointment status switches to 'Completed'
        if ($newStatus === 'Completed' && $oldStatus !== 'Completed') {
            
            // Query your singular 'donation' table to get the blood type data
            $donation = DB::table('donation')
                ->where('donation_id', $appointment->donation_id)
                ->first();

            if ($donation) {
                // Safely insert the new unit into your singular 'inventory' table
                DB::table('inventory')->insert([
                    'donation_id'      => $donation->donation_id,
                    'blood_type'       => $donation->blood_type,
                    'blood_components' => $donation->blood_components,
                    'status'           => 'Available',
                    'collection_date'  => Carbon::today()->toDateString(),
                    'expiry_date'      => Carbon::today()->addDays(42)->toDateString(),
                    'created_at'       => Carbon::now(),
                    'updated_at'       => Carbon::now(),
                ]);
            }
        }

        // SCENARIO 2: Staff moves a Completed appointment back to Scheduled/Cancelled
        elseif ($newStatus !== 'Completed' && $oldStatus === 'Completed') {
            DB::table('inventory')
                ->where('donation_id', $appointment->donation_id)
                ->delete();
        }
    }
}