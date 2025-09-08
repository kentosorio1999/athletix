<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance'; // add this
    protected $primaryKey = 'attendance_id';
    protected $fillable = [
        'athlete_id',
        'event_id',
        'status',
        'removed'
    ];

    public function athlete()
    {
        return $this->belongsTo(Athlete::class, 'athlete_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'athlete_team', 'athlete_id', 'team_id')->withTimestamps();
    }

}
