<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory; 
    protected $fillable = [
        'job_id','schedule', 'status', 
    ];
    public function interviewer(){
        return $this->belongsTo(interviewer::class);
    }
    public function canidate(){
        return $this->belongsTo(candidate::class);
    } public function job(){
        return $this->belongsTo(job::class,'job_id');
    }
}
