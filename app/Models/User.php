<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function contenus()
{
    return $this->hasMany(Contenu::class, 'user_id');
}

public function favoris()
{
    return $this->hasMany(Favori::class);
}

public function historiques()
{
    return $this->hasMany(Historique::class);
}

public function telechargements()
{
    return $this->hasMany(Telechargement::class);
}

public function abonnements()
{
    return $this->hasMany(Abonnement::class, 'user_id');
}

public function abonnés()
{
    return $this->hasMany(Abonnement::class, 'cible_id');
}

public function playlists()
{
    return $this->hasMany(Playlist::class);
}

public function commentaires()
{
    return $this->hasMany(Commentaire::class);
}

}
