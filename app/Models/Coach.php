<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $primaryKey = 'coach_id';
    protected $fillable = [
        'user_id',
        'full_name',
        'specialization',
        'sport_id',
        'removed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    public function trainingNotes()
    {
        return $this->hasMany(TrainingNote::class, 'coach_id');
    }

        public function athletes()
    {
        return $this->hasMany(Athlete::class, 'sport_id', 'sport_id');
    }
}
