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
        Schema::create('historique_consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->nullable()->constrained('utilisateurs')->onDelete('set null');
            $table->foreignId('contenu_id')->constrained('contenu')->onDelete('cascade');
            $table->timestamp('date_consultation')->useCurrent();
            $table->integer('temps_ecoute_secondes')->default(0);
            $table->integer('pourcentage_completion')->default(0);
            $table->index(['utilisateur_id', 'contenu_id', 'date_consultation']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_consultations');
    }
};
