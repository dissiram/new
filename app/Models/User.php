<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;


    public function canAccessPanel(Panel $panel) : bool
    {
        return $this->role == $panel->getId() && $this->status;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'tel',
        'email',
        'password',
        'role',
        'status',
        'adresse'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function suivre() : BelongsToMany
    {
        return $this->belongsToMany(Formation::class, 'formation_user')
            ->as('souscription')
            ->withPivot('completed')
            ->withTimestamps();
    }

   public function formations() : HasMany
   {
       return $this->hasMany(Formation::class);
   }
   
   public function article() : HasMany
   {
    return $this->hasMany(Article::class);
   }
}
