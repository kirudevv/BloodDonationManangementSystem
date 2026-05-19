<?php

namespace App\Observers;

use App\Models\Donation;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DonationObserver
{
    /**
     * Handle the Donation "updated" event.
     */
    public function updated(Donation $donation): void
    {
        $oldStatus = $donation->getOriginal('status');
        $newStatus = $donation->status;

        // ---------------------------------------------------------------------
        // TRIGGER 1 - SCENARIO A: Status changed to 'Approved' -> Create Appointment
        // ---------------------------------------------------------------------
        if ($newStatus === 'Approved' && $oldStatus !== 'Approved') {
            DB::table('appointments')->insert([
                'user_id'     => $donation->user_id,
                'hospital_id' => $donation->hospital_id,
                'donation_id' => $donation->donation_id,
                'status'      => 'Scheduled',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);
        }

        // ---------------------------------------------------------------------
        // TRIGGER 1 - SCENARIO B: Status changed back to 'Screening' -> Remove Appointment
        // ---------------------------------------------------------------------
        elseif ($newStatus === 'Screening' && $oldStatus === 'Approved') {
            DB::table('appointments')
                ->where('donation_id', $donation->donation_id)
                ->where('status', 'Scheduled') // Only delete if it hasn't been completed yet
                ->delete();
        }
    }
}