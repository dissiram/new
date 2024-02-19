<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fichier extends Model
{
    use HasFactory;

    protected $fillable  = [
        'url',
        'description'
    ];

    public function session() : BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

}
