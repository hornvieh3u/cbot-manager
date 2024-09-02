<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RobotInfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'robot_serial',
        'robot_name',
        'robot_password',
        'robot_number',
        'user_id',
    ];

    protected $table = 'robots_info_table';

    public function corridorDisinfection()
    {
        return $this->hasMany(CorridorDisinfection::class, "robot_serial", "robot_serial");
    }

    public function roomDisinfection()
    {
        return $this->hasMany(RoomDisinfection::class, "robot_serial", "robot_serial");
    }
}
