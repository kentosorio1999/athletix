<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_id';
    protected $fillable = [
        'sport_id',
        'event_name',
        'event_date',
        'event_type',
        'removed'
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id', 'sport_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'event_id');
    }

    public function performance()
    {
        return $this->hasMany(Performance::class, 'event_id');
    }
}
