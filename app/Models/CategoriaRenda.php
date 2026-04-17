<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaRenda extends Model
{
    protected $fillable = ['nome'];

    public function rendas(): HasMany
    {
        return $this->hasMany(Renda::class);
    }
}
