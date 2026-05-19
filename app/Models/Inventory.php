<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;

    protected $table = 'inventory';
    protected $primaryKey = 'inventory_id';
    
    // Fillable fields for the trigger/manual updates
    protected $fillable = [
        'donation_id', 
        'blood_type', 
        'blood_components', 
        'status', 
        'collection_date', 
        'expiry_date'
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'donation_id');
    }
}