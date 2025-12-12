<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('contenus')->insert([
            [
                'titre' => 'Chants traditionnels Fon',
                'slug' => 'chants-traditionnels-fon',
                'description' => 'Musique traditionnelle du Bénin.',
                'categorie_id' => 1,
                'user_id' => 2,
                'type_contenu' => 'musique',
                'couleur_debut' => '#F59E0B',
                'couleur_fin' => '#D97706',
            ],
            [
                'titre' => 'Danse Zangbéto',
                'slug' => 'danse-zangbeto',
                'description' => 'Rituel des gardiens de la nuit.',
                'categorie_id' => 2,
                'user_id' => 3,
                'type_contenu' => 'video',
                'couleur_debut' => '#6366F1',
                'couleur_fin' => '#4F46E5',
            ],
            [
                'titre' => 'Masques Guèlèdè',
                'slug' => 'masques-gueledde',
                'description' => 'Art culturel Yoruba.',
                'categorie_id' => 3,
                'user_id' => 2,
                'type_contenu' => 'art',
                'couleur_debut' => '#EC4899',
                'couleur_fin' => '#DB2777',
            ],
            [
                'titre' => 'Culte Vodoun',
                'slug' => 'culte-vodoun',
                'description' => 'Tradition spirituelle du Sud-Bénin.',
                'categorie_id' => 4,
                'user_id' => 3,
                'type_contenu' => 'video',
                'couleur_debut' => '#10B981',
                'couleur_fin' => '#059669',
            ],
            [
                'titre' => 'Histoire du royaume du Danhomè',
                'slug' => 'histoire-royaume-danhomè',
                'description' => 'Analyse historique du royaume.',
                'categorie_id' => 5,
                'user_id' => 2,
                'type_contenu' => 'histoire',
                'couleur_debut' => '#F43F5E',
                'couleur_fin' => '#BE123C',
            ],
        ]);
    }
}
