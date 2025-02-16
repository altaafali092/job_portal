<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'image',
    ];

    public function setImageAttribute($value)
    {

        $this->attributes['image'] = $value->store('profile', 'public');
    }

    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
    public function user(): BelongsTo
    {
        return $this->belongs(User::class);
    }
}
