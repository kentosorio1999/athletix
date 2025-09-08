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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'athlete_id');
    }

    public function performance()
    {
        return $this->hasMany(Performance::class, 'athlete_id');
    }
}
