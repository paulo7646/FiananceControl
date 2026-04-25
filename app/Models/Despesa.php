<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Despesa extends Model
{
    protected $fillable = [
        'nome',
        'valor',
        'user_id',
        'categoria_id',
        'mes_id',
        'ano_id',
        'pago',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
    ];

    /**
     * Relações carregadas automaticamente para evitar N+1 queries.
     */
    protected $with = ['user', 'categoria', 'mes', 'ano'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaDespesa::class, 'categoria_id');
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
