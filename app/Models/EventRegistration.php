<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model {
    protected $fillable = ['event_id', 'athlete_id', 'status'];

    public function event() {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function athlete() {
        return $this->belongsTo(Athlete::class, 'athlete_id');
    }
}