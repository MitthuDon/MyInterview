<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class interviewer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password','company','position'
    ];

    protected $hidden = [
        'password',
    ];

    public function jobs(){
        return $this->hasMany(job::class);
    }
    public function interviews(){
        return $this->hasMany(Interview::class);
    }
}
