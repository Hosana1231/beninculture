<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contenu extends Model
{
    protected $table = 'contenus';

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

    // Relation avec les médias
    public function media(): HasMany
    {
        return $this->hasMany(Media::class, 'contenu_id');
    }

    // Relation avec la catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    // Relation avec l'utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
