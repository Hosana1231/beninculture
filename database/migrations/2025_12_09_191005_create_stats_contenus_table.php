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
        Schema::create('stats_contenus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contenu_id')->unique()->constrained('contenu')->onDelete('cascade');
            $table->integer('vues_semaine')->default(0);
            $table->integer('vues_mois')->default(0);
            $table->integer('vues_total')->default(0);
            $table->integer('likes_semaine')->default(0);
            $table->integer('likes_mois')->default(0);
            $table->integer('partages_semaine')->default(0);
            $table->integer('partages_mois')->default(0);
            $table->integer('telechargements_total')->default(0);
            $table->timestamp('date_dernier_calcul')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stats_contenus');
    }
};
