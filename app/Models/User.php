<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory; // 👈 add HasFactory here

    protected $table = 'users';   // name of your table
    protected $primaryKey = 'user_id'; // primary key column
    public $timestamps = false;   // since you only have created_at (no updated_at)

    protected $fillable = [
        'username',
        'password',
        'first_name',
        'last_name',
        'role_id',
        'profile_image',
        'status',
    ];

    protected $hidden = [
        'password',
    ];
}
