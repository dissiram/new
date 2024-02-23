<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
        'start_at',
        'image',
        'categorie_id'
    ];

    protected $casts = [
        'image'  => 'array'
    ];

    public function categorie() : BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }
}
