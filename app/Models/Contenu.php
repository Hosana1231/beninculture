<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'categorie_id',
        'user_id',
        'type_contenu',
        'description',
        'couleur_debut',
        'couleur_fin',
        'vues',
        'likes',
        'est_featured'
    ];

    public function categorie()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
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
    protected static function boot()
{
    parent::boot();

    static::creating(function ($contenu) {
        $contenu->slug = Str::slug($contenu->titre);
    });
}

}
