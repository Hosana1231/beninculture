<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'nom' => 'Musique',
                'slug' => 'musique',
                'couleur_debut' => '#F59E0B',
                'couleur_fin' => '#D97706',
            ],
            [
                'nom' => 'Vidéo',
                'slug' => 'video',
                'couleur_debut' => '#6366F1',
                'couleur_fin' => '#4F46E5',
            ],
            [
                'nom' => 'Art',
                'slug' => 'art',
                'couleur_debut' => '#EC4899',
                'couleur_fin' => '#DB2777',
            ],
            [
                'nom' => 'Tradition',
                'slug' => 'tradition',
                'couleur_debut' => '#10B981',
                'couleur_fin' => '#059669',
            ],
            [
                'nom' => 'Histoire',
                'slug' => 'histoire',
                'couleur_debut' => '#F43F5E',
                'couleur_fin' => '#BE123C',
            ],
        ]);
    }
}
