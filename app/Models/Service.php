<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'tarif'
    ];

    public function image() : HasOne
    {
        return $this->hasOne(Fichier::class);
    }
}
