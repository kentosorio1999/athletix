<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $primaryKey = 'sport_id';
    protected $fillable = ['sport_name', 'removed'];

    public function athletes()
    {
        return $this->hasMany(Athlete::class, 'sport_id');
    }

    public function coaches()
    {
        return $this->hasMany(Coach::class, 'sport_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'sport_id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'sport_id');
    }
}
