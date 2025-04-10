<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantUser extends Model
{
    use HasFactory;


    protected $casts = [
        'completed_at' => 'datetime',
    ];
    protected $table = 'plant_user'; 
    protected $fillable = 
    [
        'user_id',
        'plant_id',
        'name',
        'location',
        'image'
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}  
    // Define the many-to-many relationship to Maintenance through the maintenance_log pivot table
    public function maintenances()
    {
        return $this->belongsToMany(Maintenance::class, 'maintenance_log')
                    ->using(MaintenanceLog::class)
                    ->withPivot('completed_at')
                    ->withTimestamps();
    }

    public function logs()
    {
        return $this->hasMany(MaintenanceLog::class, 'plant_user_id');
    }

    public function isEmpty()
    {
        return empty($this->name) && empty($this->location) && empty($this->image);
    }
}
