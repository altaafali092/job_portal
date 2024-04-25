<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class jobApplication extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'job_id',
        'user_id',
        'employer_id', 
        'applied_date',
    ];

    
    public function job():BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
 public function user():BelongsTo
 {
    return $this->belongsTo(User::class);
 }

}
