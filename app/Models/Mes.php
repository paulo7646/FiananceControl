<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mes extends Model
{
    protected $table = 'mes';

    protected $fillable = [
        'nome',
        'despesa',
        'renda',
        'total',
        'ano_id',
    ];

    protected $casts = [
        'despesa' => 'decimal:2',
        'renda' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * ⚠️ REMOVIDO: $with carregava 'ano' em TODAS as queries.
     * O eager loading deve ser explicitado onde necessário.
     */

    public function ano(): BelongsTo
    {
        return $this->belongsTo(Ano::class);
    }

    public function despesas(): HasMany
    {
        return $this->hasMany(Despesa::class);
    }

    public function rendas(): HasMany
    {
        return $this->hasMany(Renda::class);
    }

    public function recalcularTotais(): void
    {
        $this->despesa = $this->despesas()->sum('valor');
        $this->renda = $this->rendas()->sum('valor');

        $this->total = $this->renda - $this->despesa;

        $this->save();
    }



}
