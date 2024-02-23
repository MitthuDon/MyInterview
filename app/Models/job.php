<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function interviews():HasMany{
        return  $this->hasMany(Interview::class);
    }
}
