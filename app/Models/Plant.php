<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'info',
        'species',
        'location',
        'image',
        'date_added'
        ];

        public function notes()
        {
            return $this->hasMany(Note::class);
        }

        public function maintenances()
        {
            return $this->belongsTo(Maintenance::class);
        }

        public function users()
        {
            return $this->belongsToMany(User::class, 'plant_user')->withPivot(['name', 'location', 'image'])->withTimestamps();
        }
        

}
