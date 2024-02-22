<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'salary'
    ];
    public function interviewer(){
        return $this->belongsTo(interviewer::class);
    }
    public function candidates()
    {
        return $this->belongsToMany(candidate::class);
    }
}
