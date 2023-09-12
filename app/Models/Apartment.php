<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'identify',
        'condominium_id'
    ];

    public function condominium(): BelongsTo
    {
        return $this->belongsTo(Condominium::class);
    }

    public function garage(): HasMany
    {
        return $this->hasMany(Garage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
