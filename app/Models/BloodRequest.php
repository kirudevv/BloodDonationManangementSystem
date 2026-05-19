<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Hospital;

class BloodRequest extends Model
{
    use SoftDeletes;
    
    protected $table = 'bloodrequests';
    protected $primaryKey = 'request_id';
    
    
    protected $fillable = [
        'user_id', 'blood_type', 'blood_components', 'units', 'quantity', 'gender', 'urgency', 'attending_physician', 'address', 'hospital_id', 'status',
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hospital():BelongsTo{
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
