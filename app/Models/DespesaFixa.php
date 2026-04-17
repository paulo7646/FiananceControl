<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DespesaFixa extends Model
{
    protected $fillable = [
        'nome',
        'valor',
        'user_id',
        'categoria_id', 
    ];

    protected $casts = [
        'valor' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaDespesa::class, 'categoria_id');
    }
}
