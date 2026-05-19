<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasFactory;
use Illuminate\Database\Eloquent\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    //
    use SoftDeletes;
    
    protected $table='hospital';
    protected $primaryKey = 'hospital_id';
    
    protected $fillable = [
        'hospital_name', 'address', 'contact_person', 'phone_number', 'hospital_email',
    ];
}
