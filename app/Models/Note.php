<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'plant_id',
        'note',
        'task',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}
