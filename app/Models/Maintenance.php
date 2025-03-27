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
        'care_level'
    ];

    public function plant()
    {
        return $this->hasMany(Plant::class);
    }
}
