<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Renda extends Model
{
    protected $fillable = [
        'nome',
        'valor',
        'user_id',
        'categoria_id',
        'mes_id',
        'ano_id',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
    ];

    /**
     * ⚠️ REMOVIDO: $with carregava 4 relações em TODAS as queries,
     * inclusive agregações SUM/COUNT. O eager loading deve ser
     * explicitado onde necessário (Resources, Controllers).
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaRenda::class, 'categoria_id');
    }

    public function mes(): BelongsTo
    {
        return $this->belongsTo(Mes::class);
    }

    public function ano(): BelongsTo
    {
        return $this->belongsTo(Ano::class);
    }
}
