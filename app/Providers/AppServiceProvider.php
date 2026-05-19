<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Intercept EVERY database query to run your automation automatically
        DB::listen(function ($query) {
            $sql = strtolower($query->sql);
            
            // -----------------------------------------------------------------
            // AUTOMATION 1: Catch when an appointment is marked 'Completed'
            // -----------------------------------------------------------------
            if (str_contains($sql, 'update `appointments`')) {
                foreach ($query->bindings as $binding) {
                    if ($binding === 'Completed') {
                        // Get the latest completed appointment
                        $appointment = DB::table('appointments')->where('status', 'Completed')->orderBy('updated_at', 'desc')->first();
                        
                        if ($appointment) {
                            // Check if it's already in inventory to prevent duplicates
                            $exists = DB::table('inventory')->where('donation_id', $appointment->donation_id)->exists();
                            
                            if (!$exists) {
                                $donation = DB::table('donation')->where('donation_id', $appointment->donation_id)->first();
                                if ($donation) {
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
                        }
                    }
                }
            }

            // -----------------------------------------------------------------
            // AUTOMATION 2: Catch when a donation is marked 'Approved'
            // -----------------------------------------------------------------
            if (str_contains($sql, 'update `donation`')) {
                foreach ($query->bindings as $binding) {
                    if ($binding === 'Approved') {
                        // Get the latest approved donation
                        $donation = DB::table('donation')->where('status', 'Approved')->orderBy('updated_at', 'desc')->first();
                        
                        if ($donation) {
                            // Check if an appointment already exists for this donation
                            $exists = DB::table('appointments')->where('donation_id', $donation->donation_id)->exists();
                            
                            if (!$exists) {
                                DB::table('appointments')->insert([
                                    'user_id'     => $donation->user_id,
                                    'hospital_id' => $donation->hospital_id,
                                    'donation_id' => $donation->donation_id,
                                    'status'      => 'Scheduled',
                                    'created_at'  => Carbon::now(),
                                    'updated_at'  => Carbon::now(),
                                ]);
                            }
                        }
                    }
                }
            }
        });
    }
}