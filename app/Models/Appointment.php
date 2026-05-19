<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'appointment_id';
    protected $fillable = ['user_id', 'hospital_id', 'donation_id', 'request_id', 'status'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'donation_id');
    }

    public function bloodRequest()
    {
        return $this->belongsTo(BloodRequest::class, 'request_id');
    }
}