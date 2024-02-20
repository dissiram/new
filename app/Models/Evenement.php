<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
        'start_at'
    ];

    public function images() : HasOne
    {
        return $this->hasOne(Fichier::class);
    }

    public function categorie() : BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }
}
