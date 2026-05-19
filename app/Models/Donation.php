<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Inventory;

class Donation extends Model
{
    use SoftDeletes;

    
    protected static function booted(): void{
    static::updated(function ($donation) {
        // Only trigger if the status was changed specifically to 'Approved'
        if ($donation->wasChanged('status') && $donation->status === 'Approved') {
            \App\Models\Inventory::create([
                'donation_id' => $donation->donation_id,
                'blood_type'  => $donation->blood_type,
                'status'      => 'Available',
                'expiry_date' => now()->addDays(42), // Standard shelf life
            ]);
        }
    });

    }
    
    protected $casts = [
        'status' => \App\Enum\DonateStatus::class,
    ];
    use HasFactory;

    protected $table = 'donation'; 
    protected $primaryKey = 'donation_id';
    public $incrementing = true;

    protected $fillable = [
        'user_id', 'blood_type', 'blood_components', 'units_donated', 'hemoglobin_level', 'donation_date', 'gender', 'weight_kg', 'last_donation_date', 'medical_condition', 'status', 'hospital_id',
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hospital():BelongsTo{
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public $timestamps = true;
    

}
