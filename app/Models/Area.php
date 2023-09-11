<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 */
class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';

    protected $fillable = [
        'name',
        'days',
        'start_time',
        'end_time',
        'condominium_id',
        'allowed'
    ];

    public function condominium(): belongsTo
    {
        return $this->belongsTo(Condominium::class);
    }
}
