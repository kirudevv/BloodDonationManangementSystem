<?php

namespace App\Observers;

use App\Models\BloodRequest;
use App\Models\Appointment;

class BloodRequestObserver
{
    public function created(BloodRequest $bloodRequest)
    {
        // Automatically create an appointment when a request record is made
        Appointment::create([
            'user_id'     => $bloodRequest->user_id,
            'hospital_id' => $bloodRequest->hospital_id,
            'request_id'  => $bloodRequest->request_id,
            'status'      => 'Scheduled',
        ]);
    }
}