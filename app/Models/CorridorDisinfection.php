<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorridorDisinfection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'unit',
        'floor',
        'corridor_number',
        'spots_count',
        'date',
        'duration',
        'is_completed',
        'robot_serial',
    ];

    protected $table = 'corridor_disinfection_table';
}
