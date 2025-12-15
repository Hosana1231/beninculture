<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Contenu;
use App\Models\Media;

class ContenuSeeder extends Seeder
{
    public function run()
    {

       
        // 2. Crée des contenus avec médias
        $contenus = [
            [
                'titre' => 'Danse Traditionnelle',
                'type_contenu' => 'video',
                'categorie_id' => 1,
                'description' => 'Danse traditionnelle du Bénin',
                'image_url' => 'https://images.unsplash.com/photo-1511379938547-c1f69b13d835?w=400&h=400&fit=crop',
                'media_url' => 'https://exemple.com/videos/danse.mp4',
            ],
            [
                'titre' => 'Musique Vaudou',
                'type_contenu' => 'musique',
                'categorie_id' => 2,
                'description' => 'Musique traditionnelle vaudou',
                'image_url' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=400&h=400&fit=crop',
                'media_url' => 'https://exemple.com/audio/musique.mp3',
            ],
        ];

        foreach ($contenus as $data) {
            $contenu = Contenu::create([
                'titre' => $data['titre'],
                'slug' => \Str::slug($data['titre']),
                'categorie_id' => $data['categorie_id'],
                'user_id' => 1,
                'type_contenu' => $data['type_contenu'],
                'description' => $data['description'],
            ]);

            // Image
            Media::create([
                'contenu_id' => $contenu->id,
                'type_media' => 'image',
                'url' => $data['image_url']
            ]);

            // Vidéo/Audio
            Media::create([
                'contenu_id' => $contenu->id,
                'type_media' => $data['type_contenu'] === 'musique' ? 'audio' : 'video',
                'url' => $data['media_url']
            ]);
        }

        echo "✅ Données de test créées!\n";
    }
}
