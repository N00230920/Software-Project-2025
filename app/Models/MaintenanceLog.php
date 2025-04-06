<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceLog extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'plant_user_id', 
        'maintenance_id', 
        'completed_at',
    ];
}
