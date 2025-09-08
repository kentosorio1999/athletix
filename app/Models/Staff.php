<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $primaryKey = 'staff_id';
    protected $fillable = [
        'user_id',
        'full_name',
        'position',
        'removed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
