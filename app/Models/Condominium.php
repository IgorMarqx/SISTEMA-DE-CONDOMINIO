<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Condominium extends Model
{
    use HasFactory;

    public $table = 'condominiums';

    protected $fillable = [
        'name',
        'address',
        'color',
    ];

    public function area(): HasMany
    {
        return $this->hasMany(Area::class);
    }

    public function apartment(): HasMany
    {
        return $this->hasMany(Apartment::class);
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
