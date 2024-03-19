<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'sous-titre',
        'contenu',
        'formation_id'
    ];

    public function formation() : BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    public function fichiers() : HasMany
    {
        return $this->hasMany(Fichier::class);
    }
}
