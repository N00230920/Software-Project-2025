<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'plant_id', 
        'task', 
        'frequency',
        'care_level',
        'plant_user_id',
        'created_at',
        'updated_at',
    ];


    public function plantUser()
    {
        return $this->belongsTo(PlantUser::class);
    }

    public function logs()
{
    return $this->hasMany(MaintenanceLog::class);
}

}
