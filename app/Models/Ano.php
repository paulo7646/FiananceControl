<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ano extends Model
{
    protected $fillable = [
        'nome',
        'despesa',
        'renda', 
        'total',
    ];

    protected $casts = [
        'despesa' => 'decimal:2',
        'renda' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function meses(): HasMany
    {
        return $this->hasMany(Mes::class);
    }

    public function despesas(): HasMany
    {
        return $this->hasMany(Despesa::class);
    }

    public function rendas(): HasMany
    {
        return $this->hasMany(Renda::class);
    }

}
