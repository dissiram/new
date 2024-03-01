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
        'description',
        'session_id'
    ];

    public function session() : BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    public function evenement() : BelongsTo
    {
        return $this->belongsTo(Evenement::class);
    }

    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function articles() : BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
