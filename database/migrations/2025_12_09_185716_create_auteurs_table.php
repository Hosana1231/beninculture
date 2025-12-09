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
        Schema::create('auteurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->unique()->constrained('utilisateurs');
            $table->string('nom_auteur', 200);
            $table->text('bio_auteur')->nullable();
            $table->string('photo_auteur', 500)->nullable();
            $table->string('specialite', 150)->nullable();
            $table->string('localite', 150)->nullable();
            $table->string('site_web', 300)->nullable();
            $table->integer('nombre_publications')->default(0);
            $table->timestamp('date_inscription')->useCurrent();
            $table->index('specialite');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auteurs');
    }
};
