<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class candidate extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password','degree',
    ];

    protected $hidden = [
        'password',
    ];
    public function jobs()
    {
        return $this->belongsToMany(job::class);
    }
    public function interviews() : HasMany{
        return $this->hasMany(Interview::class);
    }
}
