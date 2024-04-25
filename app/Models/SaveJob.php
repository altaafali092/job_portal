<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaveJob extends Model
{
    use HasFactory;
    protected  $fillable=[
        'user_id',
        'job_id',
        'saved_date'
    ];
     
     public function job():BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
    
}
