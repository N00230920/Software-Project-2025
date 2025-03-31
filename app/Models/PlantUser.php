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
}
