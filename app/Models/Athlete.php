<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;

    protected $primaryKey = 'athlete_id';
    protected $fillable = [
        'full_name',
        'birthdate',
        'gender',
        'year_level',
        'section_id',
        'sport_id',
        'user_id',
        'school_id',
        'removed'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'athlete_team', 'athlete_id', 'team_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'athlete_event', 'athlete_id', 'event_id')
                    ->withTimestamps();
    }

    public function trainingNotes()
    {
        return $this->hasMany(TrainingNote::class, 'athlete_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'athlete_id');
    }

    public function performances()
    {
        return $this->hasMany(Performance::class, 'athlete_id');
    }

    public function awards()
    {
        // Explicitly specify the foreign key name if it’s not the default
        return $this->hasMany(Award::class, 'athlete_id');
    }

    public function eventRegistrations() {
        return $this->hasMany(EventRegistration::class, 'athlete_id');
    }

    public function getProfileUrlAttribute($value)
    {
        if ($value) {
            return $value; // Use uploaded image if exists
        }

        // Determine default image based on gender
        switch (strtolower($this->gender)) {
            case 'male':
                return asset('images/default_male.jpg');
            case 'female':
                return asset('images/default_female.jfif');
            default:
                return asset('images/default_neutral.webp');
        }
    }

        // Helper methods
    public function attendanceForEvent($eventId) {
        return $this->attendance()->where('event_id', $eventId)->first();
    }

    public function performanceForEvent($eventId) {
        return $this->performance()->where('event_id', $eventId)->first();
    }
}
