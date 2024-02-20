<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'contenu'
    ];

    public function categorie() : BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function images() : HasMany
    {
        return $this->hasMany(Fichier::class);
    }
}
