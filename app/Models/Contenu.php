<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    // Relation avec la catégorie (utilise "category" car c'est le nom du modèle)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    // Relation avec l'utilisateur
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
