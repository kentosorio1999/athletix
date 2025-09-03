<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $primaryKey = 'announcement_id';

    protected $fillable = [
        'title',
        'details',
        'venue',
        'date',
        'posted_by',
    ];

    // ✅ Add this relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'posted_by', 'user_id');
    }
}
