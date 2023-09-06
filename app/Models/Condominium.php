<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condominium extends Model
{
    use HasFactory;

    public $table = 'condominiums';

    protected $fillable = [
        'name',
        'address',
        'number',
    ];
}
