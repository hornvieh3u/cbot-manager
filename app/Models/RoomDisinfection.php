<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomDisinfection extends Model
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
        'room',
        'spots_count',
        'date',
        'duration',
        'is_completed',
        'robot_serial',
    ];

    protected $table = 'room_disinfection_table';
}
