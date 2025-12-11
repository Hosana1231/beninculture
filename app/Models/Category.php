<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'icone',
        'couleur_debut',
        'couleur_fin',
        'nombre_contenus'
    ];

    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'categorie_id');
    }
}
