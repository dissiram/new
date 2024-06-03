<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description'
    ];

    public function articles() : HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function evenements() : HasMany
    {
        return $this->hasMany(Evenement::class);
    }

    public function formations() : HasMany
    {
        return $this->hasMany(Formation::class);
    }

    public function nbForm()
    {
        return $this->formations()->count();
    }
}
