<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'task', 
        'frequency',
        'description'
    ];


    // Define the many-to-many relationship to PlantUser through the maintenance_log pivot table
    public function plantUsers()
    {
        return $this->belongsToMany(PlantUser::class, 'maintenance_log')
                    ->using(MaintenanceLog::class)
                    ->withPivot('completed_at')
                    ->withTimestamps();
    }

    public function logs()
    {
        return $this->hasMany(MaintenanceLog::class, 'maintenance_id');
    }

}
