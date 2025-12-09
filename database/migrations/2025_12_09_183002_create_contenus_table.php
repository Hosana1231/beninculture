<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contenus', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 200);
            $table->string('slug', 200)->unique();
            $table->text('description')->nullable();
            $table->longText('contenu_long')->nullable();
            
            // Relations
            $table->foreignId('categorie_id')->constrained('categories');
            $table->foreignId('utilisateur_id')->constrained('utilisateurs');
            
            // Type et fichiers
            $table->enum('type_contenu', ['musique', 'video', 'image', 'texte', 'podcast']);
            $table->string('fichier')->nullable(); // Chemin du fichier
            $table->string('fichier_url')->nullable(); // URL complète pour Flutter
            $table->string('fichier_original')->nullable(); // Nom original
            $table->bigInteger('taille_fichier')->nullable(); // Taille en bytes
            $table->string('format_fichier', 50)->nullable(); // mp3, mp4, etc.
            $table->string('image_couverture')->nullable();
            $table->string('image_couverture_url')->nullable();
            
            // Métadonnées
            $table->string('couleur_debut', 7)->nullable();
            $table->string('couleur_fin', 7)->nullable();
            $table->integer('duree_secondes')->nullable();
            $table->string('region', 100)->nullable();
            $table->string('tags')->nullable(); // Tags séparés par virgules
            
            // Statistiques
            $table->integer('vues')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('partages')->default(0);
            $table->integer('telecharges')->default(0);
            
            // Flags
            $table->boolean('est_featured')->default(false);
            $table->enum('statut', ['brouillon', 'publié', 'archivé'])->default('publié');
            
            // Dates
            $table->timestamp('date_publication')->nullable();
            $table->timestamps();
            
            // Index
            $table->index(['categorie_id', 'utilisateur_id', 'statut', 'est_featured', 'date_publication']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};
