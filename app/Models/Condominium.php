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
        'number',
    ];

    public function area(): HasMany
    {
        return $this->hasMany(Area::class);
    }
}
