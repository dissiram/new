<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Formation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'titre',
        'description',
        'tarif',
        'user_id'
    ];

    public function proprio() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sessions() : HasMany
    {
        return $this->hasMany(Session::class);
    }

    public function  nbSessions()
    {
        return $this->sessions()->count();
    }

    public function certification() : HasMany
    {
        return $this->hasMany(Certification::class);
    }

    public function souscrit() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'formation_user')
            ->as('abonne')
            ->withPivot('completed')
            ->withTimestamps();
    }
}
