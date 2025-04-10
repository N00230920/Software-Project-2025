<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MaintenanceLog extends Pivot
{
    use HasFactory;

    protected $table = 'maintenance_log';

    // If you want to automatically handle timestamps
    public $timestamps = true;

    protected $fillable = 
    [
        'plant_user_id', 
        'maintenance_id', 
        'completed_at',
    ];

    public function maintenance()
{
    return $this->belongsTo(Maintenance::class);
}

public function plantUser()
{
    return $this->belongsTo(PlantUser::class);
}

}
