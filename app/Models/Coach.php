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
}
