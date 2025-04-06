<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantUser extends Model
{
    use HasFactory;



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
public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function logs()
{
    return $this->hasMany(MaintenanceLog::class);
}
}
